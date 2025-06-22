<template>
  <div>
    <headerPro></headerPro>
    <menuBar ></menuBar>

    <div class="w-full md:w-10/12 shadow-sm mx-auto">
      <div class="flex flex-row-reverse justify-between">
        <!-- Lắng nghe event từ component con -->
        <filterVue
          ref="filterVueComp"
          :allProductObj="this.searchProduct.results"
          @filtered-products-changed="handleFilteredProducts"
        ></filterVue>
      </div>

      <!-- Hiển thị thông báo search results -->
      <div v-if="hasSearchResults && isFiltered == false" class="mb-4">
        <p class="text-green-600 font-semibold">
          Tìm thấy {{ searchProduct.results.length }} kết quả tìm kiếm
          <span v-if="searchProduct.results.length > searchItemsPerPage" class="text-gray-500">
            (Hiển thị {{ paginatedSearchResults.length }} kết quả trên trang {{ searchCurrentPage }})
          </span>
         
        </p>
      </div>

      <!-- Hiển thị thông báo nếu có filter -->
      <div
        v-if="isFiltered && displayProducts.length === 0"
        class="text-center py-8"
      >
        <p class="text-gray-500 text-xl">
          Không tìm thấy sản phẩm nào phù hợp với bộ lọc
        </p>
      </div>

      <div v-else-if="isFiltered" class="mb-4">
        <p class="text-blue-600 font-semibold">
          Hiển thị {{ displayProducts.length }} sản phẩm từ kết quả lọc
          <button
            @click="clearFilter()"
            class="ml-2 text-red-500 underline hover:text-red-700"
          >
            Xóa bộ lọc
          </button>
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
          <div
            v-for="product in filteredProducts"
            :key="product.id"
            class="mt-3.5"
          >
            <div
              class="bg-white min-h-[420px] hover:shadow-xl transform scale-100 hover:scale-105 shadow-lg rounded-lg p-6 mt-2 transition duration-300 "
            >
              <router-link
                :to="{ name: 'productDetail', params: { id: product.id } }"
              >
                <img
                  :src="product.src"
                  alt=""
                  class="w-full aspect-[3/2] object-cover rounded-md mb-4"
                />
                <p class="text-xl font-bold text-gray-700 mb-3">
                  {{ product.title }}
                </p>
                <p class="pt-2">
                  <span class="text-red-600 text-2xl font-bold"
                    >Giá {{ formatPrice(product.price) }}</span
                  >
                </p>
              </router-link>
            </div>
          </div>
        </div>
      </div>

      <!-- Hiển thị thông báo nếu không có sản phẩm -->
      <div
        v-if="displayProducts.length === 0 && !hasSearchResults"
        class="text-center py-8"
      >
        <p class="text-gray-500 text-xl">Không có sản phẩm nào để hiển thị</p>
      </div>

      <!-- Hiển thị kết quả tìm kiếm với phân trang -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-6" v-else-if="hasSearchResults && !isFiltered">
        <div
          v-for="product in paginatedSearchResults"
          :key="product.id"
          class="mt-3.5"
        >
          <div
            class="bg-white min-h-[420px] hover:shadow-xl transform scale-100 hover:scale-105 shadow-lg rounded-lg p-6 mt-2 transition duration-300"
          >
            <router-link
              :to="{ name: 'productDetail', params: { id: product.id } }"
            >
              <img
                :src="product.src"
                alt=""
                class="w-full aspect-[3/2] object-cover rounded-md mb-4"
              />
              <p class="text-xl font-bold text-gray-700 mb-3 overflow-ellipsis">
                {{ product.title }}
              </p>
              <p class="pt-2">
                <span class="text-red-600 text-2xl font-bold"
                  >Giá {{ formatPrice(product.price) }}</span
                >
              </p>
            </router-link>
          </div>
        </div>
      </div>

      <!-- Hiển thị sản phẩm thông thường
      <div class="grid grid-cols-4" v-else-if="!isFiltered && !hasSearchResults">
        <div
          v-for="product in products"
          :key="product.id"
          class="mt-3.5"
        >
          <div
            class="bg-white hover:shadow-xl transform scale-100 hover:scale-105 shadow-lg rounded-lg p-6 mt-2 transition duration-300"
          >
            <router-link
              :to="{ name: 'productDetail', params: { id: product.id } }"
            >
              <img
                :src="product.src"
                alt=""
                class="w-full h-[200px] rounded-md mb-4 object-fill md:h-[240px] lg:h-[250px] xl:h-[300px]"
              />
              <p class="text-xl font-bold text-gray-700 mb-3">
                {{ product.title }}
              </p>
              <p class="pt-2">
                <span class="text-red-600 text-2xl font-bold"
                  >Giá {{ formatPrice(product.price) }}</span
                >
              </p>
            </router-link>
          </div>
        </div>
      </div> -->
    </div>

    <!-- Phân trang cho kết quả tìm kiếm -->
    <div
      v-if="hasSearchResults && !isFiltered && searchTotalPages > 1"
      class="flex justify-center items-center space-x-2 mt-6 sticky bottom-0 bg-white py-4 shadow-md"
    >
      <!-- Nút trang đầu -->
      <button 
        @click="goToSearchPage(1)" 
        :disabled="searchCurrentPage === 1"
        class="px-3 py-1 rounded border disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-100"
      >
        ««
      </button>

      <!-- Nút trang trước -->
      <button 
        @click="goToSearchPage(searchCurrentPage - 1)" 
        :disabled="searchCurrentPage === 1"
        class="px-3 py-1 rounded border disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-100"
      >
        «
      </button>

      <!-- Các nút số trang -->
      <button
        v-for="btn in searchPaginationButtons"
        :key="btn"
        @click="typeof btn === 'number' && goToSearchPage(btn)"
        :disabled="btn === '...'"
        :class="[
          'px-3 py-1 rounded border transition-colors',
          btn === searchCurrentPage ? 'bg-red-700 text-white border-red-700' : 'bg-gray-200 hover:bg-gray-300',
          btn === '...' && 'cursor-default hover:bg-gray-200',
        ]"
      >
        {{ btn }}
      </button>

      <!-- Nút trang sau -->
      <button
        @click="goToSearchPage(searchCurrentPage + 1)"
        :disabled="searchCurrentPage === searchTotalPages"
        class="px-3 py-1 rounded border disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-100"
      >
        »
      </button>

      <!-- Nút trang cuối -->
      <button
        @click="goToSearchPage(searchTotalPages)"
        :disabled="searchCurrentPage === searchTotalPages"
        class="px-3 py-1 rounded border disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-100"
      >
        »»
      </button>

      <!-- Thông tin trang -->
      <div class="ml-4 text-sm text-gray-600">
        Trang {{ searchCurrentPage }} / {{ searchTotalPages }}
      </div>
    </div>

    <!-- Phân trang cho sản phẩm thông thường -->
    <!-- <div
      v-if="!isFiltered && !hasSearchResults && totalPages > 1"
      class="flex justify-center space-x-2 mt-6 sticky bottom-0 bg-white py-4 shadow-md"
    >
      <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">
        «
      </button>

      <button
        v-for="btn in paginationButtons"
        :key="btn"
        @click="typeof btn === 'number' && goToPage(btn)"
        :disabled="btn === '...'"
        :class="[
          'px-3 py-1 rounded text',
          btn === currentPage ? 'bg-red-700 text-white' : 'bg-gray-200',
          btn === '...' && 'cursor-default',
        ]"
      >
        {{ btn }}
      </button>

      <button
        @click="goToPage(currentPage + 1)"
        :disabled="currentPage === totalPages"
      >
        »
      </button>
    </div> -->
  </div>
</template>

<script>
import headerPro from "./baseComponent/headerPro.vue";
import menuBar from "./baseComponent/menuBar.vue";
import footerPro from "./baseComponent/footerPro.vue";
import filterVue from "./baseComponent/filter.vue";
import searchStore from "../stores/searchStore";

export default {
  props: ["categoryId", "id"],
  components: {
    headerPro,
    menuBar,
    footerPro,
    filterVue,
  },
  data() {
    return {
      products: [], // Sản phẩm hiện tại từ API (có phân trang)
      originalProducts: [], // Tất cả sản phẩm gốc (không phân trang)
      filteredProducts: [], // Sản phẩm đã được lọc từ component con
      currentPage: 1,
      isFiltered: false, // Trạng thái có đang lọc hay không
      searchProduct: null, // Kết quả tìm kiếm
      
      // Phân trang cho search results
      searchCurrentPage: 1,
      searchItemsPerPage: 12, // Số sản phẩm mỗi trang cho search results
      
      // Cấu hình phân trang
      limit: 12, // Số sản phẩm mỗi trang cho products thông thường
      totalItems: 0, // Tổng số items từ API
      maxVisibleButtons: 5, // Số nút hiển thị tối đa
    };
  },
  
  created() {
    this.searchProduct = searchStore();
  },

  computed: {
    searchStore() {
      return searchStore(); // lấy store từ Pinia
    },
    
    searchResults() {
      return this.searchStore.results;
    },
    
    hasSearchResults() {
      return this.searchResults && this.searchResults.length > 0;
    },
    
    // Phân trang cho search results
    searchTotalPages() {
      if (!this.hasSearchResults) return 0;
      return Math.ceil(this.searchResults.length / this.searchItemsPerPage);
    },
    
    paginatedSearchResults() {
      if (!this.hasSearchResults) return [];
      const start = (this.searchCurrentPage - 1) * this.searchItemsPerPage;
      const end = start + this.searchItemsPerPage;
      return this.searchResults.slice(start, end);
    },
    
    searchPaginationButtons() {
      const buttons = [];
      const total = this.searchTotalPages;
      const current = this.searchCurrentPage;
      const max = this.maxVisibleButtons || 5;
      const half = Math.floor(max / 2);

      if (total <= max + 2) {
        for (let i = 1; i <= total; i++) buttons.push(i);
      } else {
        if (current <= half + 2) {
          buttons.push(1, 2, 3, 4, "...", total);
        } else if (current >= total - half - 1) {
          buttons.push(1, "...", total - 3, total - 2, total - 1, total);
        } else {
          buttons.push(1, "...", current - 1, current, current + 1, "...", total);
        }
      }

      return buttons;
    },
    
    displayProducts() {
      if (this.isFiltered) {
        return this.filteredProducts;
      } else if (this.hasSearchResults) {
        return this.paginatedSearchResults;
      } else {
        return this.products;
      }
    },
    
    // Phân trang cho products thông thường
    totalPages() {
      return Math.ceil(this.totalItems / this.limit);
    },
    
    paginationButtons() {
      const buttons = [];
      const total = this.totalPages;
      const current = this.currentPage;
      const max = this.maxVisibleButtons || 5;
      const half = Math.floor(max / 2);

      if (total <= max + 2) {
        for (let i = 1; i <= total; i++) buttons.push(i);
      } else {
        if (current <= half + 2) {
          buttons.push(1, 2, 3, 4, "...", total);
        } else if (current >= total - half - 1) {
          buttons.push(1, "...", total - 3, total - 2, total - 1, total);
        } else {
          buttons.push(1, "...", current - 1, current, current + 1, "...", total);
        }
      }

      return buttons;
    },
  },

  watch: {
    // Reset search pagination khi có search results mới
    searchResults: {
      handler(newResults) {
        if (newResults && newResults.length > 0) {
          this.searchCurrentPage = 1;
        }
      },
      immediate: true
    }
  },

  methods: {
    async performSearch() {
      // Ví dụ fetch dữ liệu theo từ khóa mới
      const res = await fetch(
        `http://localhost:3000/posts?title_like=${this.keySearch}`
      );
      const data = await res.json();
      this.searchStore.setResults(data);
      this.searchCurrentPage = 1; // Reset về trang 1
    },

    formatPrice(value) {
      if (typeof value !== "number") return "N/A";
      return value.toLocaleString("vi-VN");
    },

    prevPage() {
      window.history.back();
    },

    // Xử lý khi nhận được mảng đã lọc từ component con
    handleFilteredProducts(filteredArray) {
      console.log("Nhận được mảng đã lọc từ component con:", filteredArray);
      this.filteredProducts = filteredArray;
      this.isFiltered = true;
    },

    // Xóa bộ lọc và hiển thị lại sản phẩm gốc
    clearFilter() {
      this.isFiltered = false;
      this.filteredProducts = [];
    },

    // // Xóa kết quả tìm kiếm
    // clearSearch() {
    //   // Clear search results trong store
    //   if (this.searchStore.clearResults) {
    //     this.searchStore.clearResults();
    //   } else {
    //     // Fallback nếu không có method clearResults
    //     this.searchStore.setResults([]);
    //   }

    //   // Reset search pagination
    //   this.searchCurrentPage = 1;

    //   // Reset về trang đầu và load lại products nếu cần
    //   this.currentPage = 1;
    //   if (this.loadProduct) {
    //     this.loadProduct();
    //   }
    // },

    // Phân trang cho search results
    goToSearchPage(page) {
      if (page >= 1 && page <= this.searchTotalPages) {
        this.searchCurrentPage = page;
        // Scroll to top để user thấy kết quả mới
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    },

    // Phân trang cho products thông thường
    goToPage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
        this.loadProduct();
        // Scroll to top để user thấy kết quả mới
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    },

    // Load sản phẩm với phân trang
    async loadProduct() {
      try {
        // Implement your API call here
        // const response = await fetch(`your-api-endpoint?page=${this.currentPage}&limit=${this.limit}`);
        // const data = await response.json();
        // this.products = data.products;
        // this.totalItems = data.total;
      } catch (error) {
        console.error('Error loading products:', error);
      }
    },

    // Load tất cả sản phẩm cho filter (không phân trang)
    async loadAllProducts() {
      try {
        // Implement your API call here
        // const response = await fetch('your-api-endpoint/all');
        // this.originalProducts = await response.json();
      } catch (error) {
        console.error('Error loading all products:', error);
      }
    },

    // Cập nhật số items per page cho search
    updateSearchItemsPerPage(newItemsPerPage) {
      this.searchItemsPerPage = newItemsPerPage;
      this.searchCurrentPage = 1; // Reset về trang 1
    },

    // Thống kê search results
    getSearchResultsInfo() {
      if (!this.hasSearchResults) return null;
      
      const start = (this.searchCurrentPage - 1) * this.searchItemsPerPage + 1;
      const end = Math.min(this.searchCurrentPage * this.searchItemsPerPage, this.searchResults.length);
      
      return {
        start,
        end,
        total: this.searchResults.length,
        currentPage: this.searchCurrentPage,
        totalPages: this.searchTotalPages
      };
    }
  },

  async mounted() {
    console.log("Component mounted");
    console.log("Initial searchProduct:", this.searchProduct);
    console.log("Search store:", this.searchProduct.results);
    console.log("Has search results:", this.hasSearchResults);

    // Load initial data if no search results
    if (!this.hasSearchResults) {
      await this.loadProduct();
      await this.loadAllProducts();
    }
  },
};
</script>

<style scoped>

/* Smooth transitions cho pagination */
.transition-colors {
  transition: background-color 0.2s ease, color 0.2s ease;
}

/* Hover effects cho pagination buttons */
button:hover:not(:disabled) {
  transform: translateY(-1px);
  transition: transform 0.1s ease;
}

button:active:not(:disabled) {
  transform: translateY(0);
}

/* Style cho sticky pagination */
.sticky {
  position: sticky;
  bottom: 0;
  z-index: 10;
}
</style>