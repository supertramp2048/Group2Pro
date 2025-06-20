<template>
  <div>
    <headerPro></headerPro>
    <menuBar></menuBar>

    <!-- noi dung chinh -->
    <main class="flex-1 w-full md:w-10/12 shadow-sm mx-auto">
      <div class="w-full md:w-10/12 shadow-sm mx-auto">
        <div class="flex flex-row-reverse">
          <!-- Lắng nghe event từ component con -->
          <filterVue
            ref="filterVueComp"
            :allProductObj="originalProducts"
            :categoryId="categoryId"
            @filtered-products-changed="handleFilteredProducts"
          ></filterVue>
        </div>

        <!-- Loading state -->
        <div v-if="loading" class="text-center py-8">
          <p class="text-gray-500 text-xl">Đang tải sản phẩm...</p>
        </div>

        <!-- Hiển thị thông báo nếu có filter -->
        <div
          v-else-if="isFiltered && displayProducts.length === 0"
          class="text-center py-8"
        >
           <p class="text-blue-600 font-semibold">
            Hiển thị {{ displayProducts.length }} sản phẩm từ kết quả lọc
            <button
              @click="clearFilter()"
              class="ml-2 text-red-500 underline hover:text-red-700"
            >
              Xóa bộ lọc
            </button>
          </p>
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
        </div>

        <!-- Debug info -->
        <div v-if="showDebug" class="mb-4 p-2 bg-gray-100 text-sm">
          <p>Current Page: {{ currentPage }}</p>
          <p>Total Items: {{ totalItems }}</p>
          <p>Total Pages: {{ totalPages }}</p>
          <p>Products Count: {{ products.length }}</p>
          <p>Original Products Count: {{ originalProducts.length }}</p>
          <p>Is Filtered: {{ isFiltered }}</p>
        </div>

        <!-- Product Grid -->
        <div v-if="!loading" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <div
            v-for="product in displayProducts"
            :key="product.id"
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
                  class="w-full h-[180px] rounded-md mb-3 object-contain md:h-[200px] lg:h-[220px] xl:h-[240px]"
                />
                <p class="text-sm font-semibold text-gray-800 mb-1 truncate">
                  {{ product.title }}
                </p>
                <p class="pt-2">
                  <span class="text-red-600 text-2xl font-bold"
                    v-if="product.price != 0">Giá {{ formatPrice(product.price) }}</span
                  >
                  <span v-else class="text-red-600 text-2xl font-bold">Liên Hệ</span>
                </p>
              </router-link>
            </div>
          </div>
        </div>

        <!-- Empty state khi không có sản phẩm -->
        <div v-if="!loading && !isFiltered && displayProducts.length === 0" class="text-center py-8">
          <p class="text-gray-500 text-xl">Không có sản phẩm nào trong danh mục này</p>
        </div>
      </div>

      <!-- Chỉ hiển thị pagination khi không có filter và có nhiều trang -->
      <div
        v-if="!isFiltered && !loading && totalPages > 1"
        class="flex justify-center space-x-2 mt-6 sticky bottom-0"
      >
        <button
          @click="goToPage(currentPage - 1)"
          :disabled="currentPage === 1"
          class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          «
        </button>

        <button
          v-for="btn in paginationButtons"
          :key="btn"
          @click="typeof btn === 'number' && goToPage(btn)"
          :disabled="btn === '...'"
          :class="[
            'px-3 py-1 rounded text',
            btn === currentPage ? 'bg-red-700 text-white' : 'bg-gray-200 hover:bg-gray-300',
            btn === '...' && 'cursor-default',
          ]"
        >
          {{ btn }}
        </button>

        <button
          @click="goToPage(currentPage + 1)"
          :disabled="currentPage === totalPages"
          class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          »
        </button>
      </div>
    </main>
  </div>
</template>

<script>
import headerPro from "./baseComponent/headerPro.vue";
import menuBar from "./baseComponent/menuBar.vue";
import footerPro from "./baseComponent/footerPro.vue";
import filterVue from "./baseComponent/filter.vue";

export default {
  props: ["categoryId"],
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
      
      totalItems: 0,           // Tổng số sản phẩm
      limit: 12,              // Số sản phẩm mỗi trang (tăng từ 10 lên 12)
      maxVisibleButtons: 5,   // Số nút pagination hiển thị
      showDebug: false,       // Hiển thị thông tin debug (set true để debug)
      loading: false,         // Trạng thái loading
    };
  },
  computed: {
    // Sản phẩm để hiển thị
    displayProducts() {
      return this.isFiltered ? this.filteredProducts : this.products;
    },

    totalPages() {
      if (this.isFiltered) {
        // Khi đang filter, không cần phân trang
        return 1;
      }
      if (this.totalItems === 0) return 1;
      return Math.ceil(this.totalItems / this.limit);
    },

    paginationButtons() {
      const buttons = [];
      const total = this.totalPages;
      const current = this.currentPage;
      const max = this.maxVisibleButtons;
      const half = Math.floor(max / 2);

      if (total <= max + 2) {
        for (let i = 1; i <= total; i++) buttons.push(i);
      } else {
        if (current <= half + 2) {
          buttons.push(1, 2, 3, 4, "...", total);
        } else if (current >= total - half - 1) {
          buttons.push(1, "...", total - 3, total - 2, total - 1, total);
        } else {
          buttons.push(
            1,
            "...",
            current - 1,
            current,
            current + 1,
            "...",
            total
          );
        }
      }

      return buttons;
    },
  },

  methods: {
    formatPrice(value) {
      if (typeof value !== "number") return "N/A";
      return value.toLocaleString("vi-VN");
    },

    prevPage() {
      this.$router.push("/");
    },

    // Xử lý khi nhận được mảng đã lọc từ component con
    handleFilteredProducts(filteredArray) {
      console.log("Nhận được mảng đã lọc từ component con:", filteredArray);
      this.filteredProducts = filteredArray;
      
      // Nếu filteredArray === originalProducts thì nghĩa là không có filter
      this.isFiltered = filteredArray !== this.originalProducts && 
                       filteredArray.length !== this.originalProducts.length;
    },

    // Xóa bộ lọc và hiển thị lại sản phẩm gốc
    clearFilter() {
      this.isFiltered = false;
      this.filteredProducts = [];
      
      // Reset filter component
      if (this.$refs.filterVueComp) {
        this.$refs.filterVueComp.removeChecked();
      }
      
      // Reset về trang đầu khi clear filter
      this.currentPage = 1;
      this.loadProduct();
    },

    // Load sản phẩm có phân trang
    async loadProduct() {
      try {
        this.loading = true;
        console.log(`Loading page ${this.currentPage} for category ${this.categoryId}`);
        
        const res = await fetch(
          `http://localhost:3000/API/index.php?category=${this.categoryId}&page=${this.currentPage}&limit=${this.limit}`
        );
        
        if (!res.ok) {
          throw new Error(`HTTP error! status: ${res.status}`);
        }

        const data = await res.json();
        this.products = data;
        
        // Lấy tổng số sản phẩm từ header
        const totalCount = res.headers.get("X-Total-Count");
        console.log("X-Total-Count from header:", totalCount);

        if (totalCount) {
          this.totalItems = parseInt(totalCount);
        } else {
          // Fallback: ước tính từ số sản phẩm nhận được
          console.warn("X-Total-Count header not found, using fallback method");
          if (this.products.length < this.limit) {
            this.totalItems = (this.currentPage - 1) * this.limit + this.products.length;
          } else {
            // Có thể có thêm trang
            this.totalItems = this.currentPage * this.limit + 1;
          }
        }
        
        console.log(`Loaded ${this.products.length} products, total: ${this.totalItems}`);
        
      } catch (error) {
        console.error("Error loading products:", error);
        this.products = [];
        this.totalItems = 0;
      } finally {
        this.loading = false;
      }
    },

    // Load tất cả sản phẩm cho filter (không phân trang)
    async loadAllProducts() {
      try {
        console.log(`Loading all products for category ${this.categoryId}`);
        const res = await fetch(
          `http://localhost:3000/API/index.php?category=${this.categoryId}&all=true`
        );
  
        if (!res.ok) {
          throw new Error(`HTTP error! status: ${res.status}`);
        }
        
        const data = await res.json();
        this.originalProducts = data;
        console.log(`Loaded ${this.originalProducts.length} total products for filtering`);
        
      } catch (error) {
        console.error("Error loading all products:", error);
        // Fallback: nếu không load được tất cả, dùng products hiện tại
        this.originalProducts = [...this.products];
      }
    },

    // Chuyển trang
    async goToPage(page) {
      // Kiểm tra điều kiện hợp lệ
      if (page < 1 || page > this.totalPages || this.isFiltered || this.loading) {
        return;
      }
      
      if (page !== this.currentPage) {
        console.log(`Going to page ${page}`);
        this.currentPage = page;
        await this.loadProduct();
        
        // Scroll to top khi chuyển trang
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    },

    // Reset tất cả dữ liệu khi chuyển category
    resetData() {
      this.products = [];
      this.originalProducts = [];
      this.filteredProducts = [];
      this.currentPage = 1;
      this.isFiltered = false;
      this.totalItems = 0;
      this.loading = false;
    },
  },
  
  watch: {
    categoryId: {
      immediate: true,
      async handler(newVal, oldVal) {
        if (newVal && newVal !== oldVal) {
          console.log(`Category changed from ${oldVal} to ${newVal}`);
          
          // Reset data trước khi load
          this.resetData();
          
          try {
            // Load song song để tăng tốc độ
            await Promise.all([
              this.loadProduct(),
              this.loadAllProducts()
            ]);
          } catch (error) {
            console.error("Error loading category data:", error);
          }
        }
      },
    },
  },

  // Cleanup khi component bị destroy
  beforeDestroy() {
    this.resetData();
  },
};
</script>

<style scoped>
/* Thêm một số style cải thiện UX */
.transition-all {
  transition: all 0.3s ease;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>