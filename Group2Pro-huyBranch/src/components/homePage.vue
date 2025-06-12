<template>
  <div>
    <headerPro></headerPro>
    <menuBar class="z-20"></menuBar>
    <section class="flex w-full md:w-4/5 mx-auto">
      <!--Nội dung chính của web-->

      <article class="flex-1 lg:w-4/6 lg:flex-1 w-full bg-white p-6">
        <!--Nội dung chính -->
       <div class="flex flex-col lg:flex-row">
          <aside class="w-2/6 hidden lg:block bg-gray-200 p-4">
          <router-link
            :to="{ name: 'productDetail', params: { id: 74 } }">
            <img src="/images/ads4.png" alt="" class="rounded-2xl h-1/3" />
            </router-link>
            <router-link
              :to="{ name: 'productDetail', params: { id: 73 } }">
            <img src="/images/ads5.png" alt="" class="mt-1 rounded-2xl h-1/3" />
            </router-link>
            <router-link
              :to="{ name: 'productDetail', params: { id: 73 } }">
            <img src="/images/ads5.png" alt="" class="mt-1 rounded-2xl h-1/3" />
            </router-link>
          </aside>
          <carosel class="z-10"></carosel>
          <aside class="w-2/6 hidden lg:block bg-gray-200 p-4">
          <router-link :to="{ name: 'productDetail', params: { id: 8 } }">
            <img src="/images/galaxyM55Ads.png" alt="" class="rounded-2xl h-1/3" />
            </router-link>
            <router-link
              :to="{ name: 'productDetail', params: { id: 73 } }">
            <img src="/images/ads5.png" alt="" class="mt-1 rounded-2xl h-1/3" />
            </router-link>
            <router-link
              :to="{ name: 'productDetail', params: { id: 73 } }">
            <img src="/images/ads5.png" alt="" class="mt-1 rounded-2xl h-1/3" />
            </router-link>
            
          </aside>
        </div>
        <cowndownClock></cowndownClock>
        <div class="flex flex-col">
          <!-- Điện thoại nổi bật -->
          <div class="flex items-center justify-between px-4 py-2">
            <h2 class="text-2xl font-bold uppercase text-gray-800">
              Điện thoại nổi bật nhất
            </h2>
            <router-link
              :to="{ name: 'allProducts', params: { categoryId: 1 } }"
              class="text-gray-600 hover:text-blue-600 font-medium text-xl"
            >
              Xem tất cả
            </router-link>
          </div>

          <!-- Carousel cho điện thoại -->
          <div class="relative">
            <!-- Nút điều hướng trái -->
            <button
              @click="previousPhones"
              :disabled="phoneCurrentIndex === 0"
              class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow-lg rounded-full p-2 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 19l-7-7 7-7"
                ></path>
              </svg>
            </button>

            <!-- Container sản phẩm -->
            <div class="overflow-hidden mx-8">
              <div
                class="flex transition-transform duration-300 ease-in-out"
                :style="{
                  transform: `translateX(-${phoneCurrentIndex * 25}%)`,
                }"
              >
                <div
                  v-for="product in phoneProducts"
                  :key="product.id"
                  class="w-1/4 flex-shrink-0"
                >
                  <div
                    class="bg-white hover:shadow-xl transform scale-100 hover:scale-105 shadow-lg rounded-lg p-6 mt-2 transition duration-300"
                  >
                    <router-link
                      :to="{
                        name: 'productDetail',
                        params: { id: product.id },
                      }"
                    >
                      <img
                        :src="product.src"
                        alt=""
                        class="w-full h-[120px] object-fill rounded-md mb-4 md:h-[220px] xl:h-[320px]"
                      />
                      <p
                        class="text-m md:text-2xl lg:text-2xl font-bold text-gray-700 truncate mb-3"
                      >
                        {{ product.title }}
                      </p>
                      <p class="p-2">
                        <span
                          class="text-red-600 sm:text-m lg:text-2xl md:text-2xl font-bold"
                          >Giá {{ formatPrice(product.price) }}
                        </span>
                      </p>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>

            <!-- Nút điều hướng phải -->
            <button
              @click="nextPhones"
              :disabled="phoneCurrentIndex >= phoneProducts.length - 4"
              class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow-lg rounded-full p-2 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"
                ></path>
              </svg>
            </button>
          </div>

          <br />

          <!-- Laptop nổi bật -->
          <div class="flex items-center justify-between px-4 py-2">
            <h2 class="text-2xl font-bold uppercase text-gray-800">
              Laptop nổi bật nhất
            </h2>
            <router-link
              :to="{ name: 'allProducts', params: { categoryId: 2 } }"
              class="text-gray-600 hover:text-blue-600 font-medium text-xl"
            >
              Xem tất cả
            </router-link>
          </div>

          <!-- Carousel cho laptop -->
          <div class="relative">
            <!-- Nút điều hướng trái -->
            <button
              @click="previousLaptops"
              :disabled="laptopCurrentIndex === 0"
              class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow-lg rounded-full p-2 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 19l-7-7 7-7"
                ></path>
              </svg>
            </button>

            <!-- Container sản phẩm -->
            <div class="overflow-hidden mx-8">
              <div
                class="flex transition-transform duration-300 ease-in-out"
                :style="{
                  transform: `translateX(-${laptopCurrentIndex * 25}%)`,
                }"
              >
                <div
                  v-for="product in laptopProducts"
                  :key="product.id"
                  class="w-1/4 flex-shrink-0"
                >
                  <div
                    class="bg-white hover:shadow-xl transform scale-100 hover:scale-105 shadow-lg rounded-lg p-6 mt-2 transition duration-300"
                  >
                    <router-link
                      :to="{
                        name: 'productDetail',
                        params: { id: product.id },
                      }"
                    >
                      <img
                        :src="product.src"
                        alt=""
                        class="w-full h-[120px] rounded-md mb-4 object-fill md:h-[220px] xl:h-[320px]"
                      />
                      <p
                        class="text-l sm:text-xl lg:text-2xl font-bold text-gray-700 mb-3"
                      >
                        {{ product.title }}
                      </p>
                      <p class="pt-2">
                        <span
                          class="text-red-600 text-l sm:text-xl lg:text-2xl font-bold"
                          >Giá {{ formatPrice(product.price) }}</span
                        >
                      </p>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>

            <!-- Nút điều hướng phải -->
            <button
              @click="nextLaptops"
              :disabled="laptopCurrentIndex >= laptopProducts.length - 4"
              class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow-lg rounded-full p-2 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"
                ></path>
              </svg>
            </button>
          </div>
          <!-- <-- het laptop -->

          <!-- Laptop nổi bật -->
          <div class="flex items-center justify-between px-4 py-2">
            <h2 class="text-2xl font-bold uppercase text-gray-800">
              Camera nổi bật nhất
            </h2>
            <router-link
              :to="{ name: 'allProducts', params: { categoryId: 3 } }"
              class="text-gray-600 hover:text-blue-600 font-medium text-xl"
            >
              Xem tất cả
            </router-link>
          </div>

          <!-- Carousel cho laptop -->
          <div class="relative">
            <!-- Nút điều hướng trái -->
            <button
              @click="previousCams"
              :disabled="camCurrentIndex === 0"
              class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow-lg rounded-full p-2 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 19l-7-7 7-7"
                ></path>
              </svg>
            </button>

            <!-- Container sản phẩm -->
            <div class="overflow-hidden mx-8">
              <div
                class="flex transition-transform duration-300 ease-in-out"
                :style="{
                  transform: `translateX(-${camCurrentIndex * 25}%)`,
                }"
              >
                <div
                  v-for="product in camProducts"
                  :key="product.id"
                  class="w-1/4 flex-shrink-0"
                >
                  <div
                    class="bg-white hover:shadow-xl transform scale-100 hover:scale-105 shadow-lg rounded-lg p-6 mt-2 transition duration-300"
                  >
                    <router-link
                      :to="{
                        name: 'productDetail',
                        params: { id: product.id },
                      }"
                    >
                      <img
                        :src="product.src"
                        alt=""
                        class="w-full h-[120px] rounded-md mb-4 object-fill md:h-[220px] xl:h-[320px]"
                      />
                      <p
                        class="text-l sm:text-xl lg:text-2xl font-bold text-gray-700 mb-3"
                      >
                        {{ product.title }}
                      </p>
                      <p class="pt-2">
                        <span
                          class="text-red-600 text-l sm:text-xl lg:text-2xl font-bold"
                          >Giá {{ formatPrice(product.price) }}</span
                        >
                      </p>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>

            <!-- Nút điều hướng phải -->
            <button
              @click="nextCams"
              :disabled="camCurrentIndex >= camProducts.length - 4"
              class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow-lg rounded-full p-2 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"
                ></path>
              </svg>
            </button>
          </div>
        </div>
      </article>
    </section>
    
  </div>
</template>

<script>
import menuBar from "./baseComponent/menuBar.vue";
import carosel from "./baseComponent/carosel.vue";
import cowndownClock from "./baseComponent/cowdownClock.vue";
import search from "./baseComponent/search.vue";
import headerPro from "./baseComponent/headerPro.vue";
import footerPro from "./baseComponent/footerPro.vue";
import useCartStore from "../stores/cartStore";
export default {
  components: {
    menuBar,
    carosel,
    cowndownClock,
    search,
    headerPro,
    footerPro,
  },
  data() {
    return {
      allProducts: [],
      phoneProducts: [],
      laptopProducts: [],
      camProducts: [],
      cart: null,
      phoneCurrentIndex: 0,
      laptopCurrentIndex: 0,
      camCurrentIndex: 0,
    };
  },
  created() {
    this.cart = useCartStore();
  },
  methods: {
    async loadProduct() {
      let res = await fetch("http://localhost:3000/API/index.php");
      this.allProducts = await res.json();
      console.log(localStorage.getItem('username'))
      this.phoneProducts = this.allProducts
        .filter((p) => p.category === 1)
        .slice(0, 15);
      this.laptopProducts = this.allProducts
        .filter((p) => p.category === 2)
        .slice(0, 15);
      this.camProducts = this.allProducts
        .filter((p) => p.category === 3)
        .slice(0, 15);
    },

    formatPrice(value) {
      if (typeof value !== "number") return "N/A";
      return value.toLocaleString("vi-VN");
    },

    addProduct(product) {
      this.cart.addToCart(product);
      console.log(this.cart.cart);
    },

    // Điều hướng cho điện thoại
    nextPhones() {
      if (this.phoneCurrentIndex < this.phoneProducts.length - 4) {
        this.phoneCurrentIndex++;
      }
    },

    previousPhones() {
      if (this.phoneCurrentIndex > 0) {
        this.phoneCurrentIndex--;
      }
    },

    // Điều hướng cho laptop
    nextLaptops() {
      if (this.laptopCurrentIndex < this.laptopProducts.length - 4) {
        this.laptopCurrentIndex++;
      }
    },

    previousLaptops() {
      if (this.laptopCurrentIndex > 0) {
        this.laptopCurrentIndex--;
      }
    },
    // dieu huong camemra

    nextCams() {
      if (this.camCurrentIndex < this.camProducts.length - 4) {
        this.camCurrentIndex++;
      }
    },

    previousCams() {
      if (this.camCurrentIndex > 0) {
        this.camCurrentIndex--;
      }
    },
  },

  mounted() {
    this.loadProduct();
  },
};
</script>