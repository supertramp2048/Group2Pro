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

        <div class="grid grid-cols-4">
          <div
            v-for="product in displayProducts"
            :key="product.id"
            class="mt-3.5"
          >
            <div
              class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow duration-300"
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
        v-if="!isFiltered"
        class="flex justify-center space-x-2 mt-6 sticky bottom-0"
      >
        <button
          @click="goToPage(currentPage - 1)"
          :disabled="currentPage === 1"
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
      </div>
      </main>
    <footerPro></footerPro>
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
    };
  },
  computed: {
    // Sản phẩm để hiển thị
    displayProducts() {
      return this.isFiltered ? this.filteredProducts : this.products;
    },

    totalPages() {
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
    },

    // Load sản phẩm với phân trang
    async loadProduct() {
      console.log(this.categoryId)
      let res = await fetch(
        `http://localhost:3000/API/index.php?category=${this.categoryId}&_page=${this.currentPage}&_limit=20`
      );
      this.products = await res.json();
      this.totalItems = parseInt(res.headers.get("X-Total-Count")) || 0;
      console.log(this.products);
    },

    // Load tất cả sản phẩm cho filter (không phân trang)
    async loadAllProducts() {
      let res = await fetch(
        `http://localhost:3000/API/index.php?category=${this.categoryId}`
      );
      this.originalProducts = await res.json();
    },

    goToPage(page) {
      if (page >= 1 && page <= this.totalPages && !this.isFiltered) {
        this.currentPage = page;
        this.loadProduct();
      }
    },
  },
  watch: {
    categoryId: {
      immediate: true,
      handler(newVal) {
        this.currentPage = 1;
        this.loadProduct();
        this.loadAllProducts();
      },
    },
  },
};
</script>