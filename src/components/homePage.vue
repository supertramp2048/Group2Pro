

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
          <div class="grid grid-flow-col grid-col-4 gap-4">
            <div
              v-for="product in phoneProducts"
              :key="product.id"
              class="shadow-black shadow-xs"
            >
              <router-link :to="{ name: 'productDetail', params: { id: product.id } } ">
                <img :src="product.src" alt="" class="w-[200px] h-[250px]" />
                <p class="font-bold text-gray-600">{{ product.title }}</p>
                <p>
                  <span class="text-red-600"
                    >Giá {{ formatPrice(product.price) }} </span
                  >
                </p>
              </router-link>
              <button @click="cart.push(product)">Them vao gio hang</button>
            </div>
          </div>
          <br />
          <h2>Laptop</h2>
          <div class="grid grid-flow-col grid-col-4 gap-4">
            <div
              v-for="product in laptopProducts"
              :key="product.id"
              class="shadow-black shadow-xs"
            >
            <router-link :to="{ name: 'productDetail', params: { id: product.id } } ">
              <img :src="product.src" alt="" class="w-[200px] h-[300px]" />
              <p class="font-bold text-gray-600">{{ product.title }}</p>
              <p>
                <span class="text-red-600"
                  >Giá {{ formatPrice(product.price) }}</span
                >
              </p>
            </router-link>
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
      cart: [],
    };
  },
  methods: {
    async loadProduct() {
      let res = await fetch("http://localhost:3000/posts");
      this.allProducts = await res.json();

      this.phoneProducts = this.allProducts.filter((p) => p.categoryId === 1);
      this.laptopProducts = this.allProducts.filter((p) => p.categoryId === 2);
    },

    formatPrice(value) {
      if (typeof value !== "number") return "N/A";
      return value.toLocaleString("vi-VN");
    },
    testId(data){
         console.log(data);
         
    }
  },

  mounted() {
    this.loadProduct();
  },
};
</script>