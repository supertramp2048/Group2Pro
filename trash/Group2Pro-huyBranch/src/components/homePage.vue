

<template>
  <div>
    <headerPro></headerPro>
    <menuBar class="z-20"></menuBar>
    <section class="flex">
      <!--Nội dung chính của web-->
      <aside class="w-1/7 bg-gray-200 p-4"></aside>
      <article class="flex-1 bg-white p-6">
        <!--Nội dung chính -->
        <carosel class="fixed z-10"></carosel>
        <cowndownClock></cowndownClock>
        <div class="flex flex-col">
          <h2>Điện thoại</h2>
          <div class="grid grid-flow-col grid-col-4 gap-4 ">
            <div
              v-for="product in phoneProducts"
              :key="product.Id"
              class="shadow-black shadow-xs"
            >
              <router-link
                :to="{ name: 'productDetail', params: { id: product.Id } }"
              >
                <img :src="product.Src" alt="" class="w-[200px] h-[250px]" />
                <p class="font-bold text-gray-600">{{ product.Title }}</p>
                <p>
                  <span class="text-red-600"
                    >Giá {{ formatPrice(product.Price) }}
                  </span>
                </p>
              </router-link>
              <button @click="addProduct(product)" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                Them vao gio hang
              </button>
            </div>
          </div>
          <br />
          <h2>Laptop</h2>
          <div class="grid grid-flow-col grid-col-4 gap-4 p-1.5">
            <div
              v-for="product in laptopProducts"
              :key="product.Id"
              class="shadow-black shadow-xs"
            >
              <router-link
                :to="{ name: 'productDetail', params: { id: product.Id } }"
              >
                <img :src="product.Src" alt="" class="w-[200px] h-[200px]" />
                <p class="font-bold text-gray-600">{{ product.Title }}</p>
                <p>
                  <span class="text-red-600"
                    >Giá {{ formatPrice(product.Price) }}</span
                  >
                </p>
              </router-link>
              <button @click="addProduct(product)" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                Them vao gio hang
              </button>
            </div>
          </div>
        </div>
      </article>
      <aside class="w-1/7 bg-gray-200 p-4"></aside>
    </section>
    <footerPro></footerPro>
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
      cart: null,
    };
  },
  created() {
    this.cart = useCartStore();
  },
  methods: {
    async loadProduct() {
     let res = await fetch("http://localhost:3000/API/index.php");
     //let res = await fetch("http://localhost:3000/API/src/test-post.php"); // Thay đổi URL cho phù hợp với API của bạn
      if (!res.ok) {
        console.error("Failed to fetch products:", res.statusText);
        return;
      }
     this.allProducts = await res.json();

      this.phoneProducts = this.allProducts.filter((p) => p.Category === 1);
      this.laptopProducts = this.allProducts.filter((p) => p.Category === 2);
    },

    formatPrice(value) {
      if (typeof value !== "number") return "N/A";
      return value.toLocaleString("vi-VN");
    },
    addProduct(product) {
      this.cart.addToCart(product); // gọi action thêm sp vào giỏ (theo tên action trong store)
      console.log(this.cart.cart); // in ra giỏ hàng để kiểm tra
    },
  },

  mounted() {
    this.loadProduct();
  },
};
</script>
