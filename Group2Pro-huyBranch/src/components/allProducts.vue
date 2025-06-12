<template>
  <div>
    <headerPro></headerPro>
    <menuBar></menuBar>

    <!-- noi dung chinh -->
    <main class="flex-1 w-full md:w-10/12 shadow-sm mx-auto">
      <div class="w-full md:w-10/12 shadow-sm mx-auto">
        <div class="flex justify-between">
          <button
            @click="prevPage()"
            class="text-2xl text-black block hover:bg-gray-200"
          >
            <!-- Icon mũi tên trái -->
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="size-10"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"
              />
            </svg>
          </button>

          <!-- Lắng nghe event từ component con -->
          <filterVue
            ref="filterVueComp"
            :allProductObj="originalProducts"
            @filtered-products-changed="handleFilteredProducts"
          ></filterVue>
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
        </div>

        <!-- Debug info -->
        <div v-if="showDebug" class="mb-4 p-2 bg-gray-100 text-sm">
          <p>Current Page: {{ currentPage }}</p>
          <p>Total Items: {{ totalItems }}</p>
          <p>Total Pages: {{ totalPages }}</p>
          <p>Products Count: {{ products.length }}</p>
          <p>Is Filtered: {{ isFiltered }}</p>
        </div>

        <div class="grid grid-cols-4">
          <div
            v-for="product in displayProducts"
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
                  class="w-full h-[200px] rounded-md mb-4 object-fill md:h-[240px] lg:h-[250px] xl:h-[400px]"
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

      <!-- Chỉ hiển thị pagination khi không có filter -->
      <div
        v-if="!isFiltered && totalPages > 1"
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
      
      // ✅ Thêm các thuộc tính bị thiếu
      totalItems: 0,           // Tổng số sản phẩm
      limit: 10,              // Số sản phẩm mỗi trang
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
      this.isFiltered = true;
    },

    // Xóa bộ lọc và hiển thị lại sản phẩm gốc
    clearFilter() {
      this.isFiltered = false;
      this.filteredProducts = [];
      // Reset về trang đầu khi clear filter
      this.currentPage = 1;
      this.loadProduct();
    },

    // ✅ Cải thiện load product với error handling
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

        this.products = await res.json();
        
        // Kiểm tra header X-Total-Count
        /*.then(res=> {
          const totalCount = res.headers.get("X-Total-Count");
          console.log("X-Total-Count:", totalCount);

        });*/
        //const totalCount = this.originalProducts.length; 
        const totalCount = res.headers.get("X-Total-Count"); // Lấy giá trị từ header, nếu không có thì trả về null
        console.log("độ dài của mảng originalProducts:", this.originalProducts.length);
        //const total = res.headers.get("X-Total-Count"); // Lấy giá trị từ header, nếu không có thì trả về null
        console.log("X-Total-Count:", totalCount);

        if (totalCount) {
          this.totalItems = parseInt(totalCount);
        } else {
          // Fallback: nếu không có header, tính từ số sản phẩm nhận được
          console.warn("X-Total-Count header not found, using fallback method");
          this.totalItems = this.products.length < this.limit ? 
            (this.currentPage - 1) * this.limit + this.products.length : 
            this.currentPage * this.limit + 1; // Giả định có ít nhất 1 trang nữa
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
          `http://localhost:3000/API/index.php?category=${this.categoryId}`
        );
  
        if (!res.ok) {
          throw new Error(`HTTP error! status: ${res.status}`);
        }
        
        this.originalProducts = await res.json();
        console.log(`Loaded ${this.originalProducts.length} total products for filtering`);
        
      } catch (error) {
        console.error("Error loading all products:", error);
        this.originalProducts = [];
      }
    },

    // ✅ Cải thiện goToPage
    goToPage(page) {
      // Kiểm tra điều kiện hợp lệ
      if (page < 1 || page > this.totalPages || this.isFiltered || this.loading) {
        return;
      }
      
      if (page !== this.currentPage) {
        console.log(`Going to page ${page}`);
        this.currentPage = page;
        this.loadProduct();
        
        // Scroll to top khi chuyển trang
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    },
  },
  
  watch: {
    categoryId: {
      immediate: true,
      async handler(newVal) {
        if (newVal) {
          console.log(`Category changed to: ${newVal}`);
          this.currentPage = 1;
          this.isFiltered = false;
          this.filteredProducts = [];
          
          // Load cả hai loại data
          await Promise.all([
            
            this.loadAllProducts(),
            this.loadProduct(),
          ]);
        }
      },
    },
  },
};
</script>