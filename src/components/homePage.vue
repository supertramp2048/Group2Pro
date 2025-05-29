

<template>
  <div>
    <header>
      <!--Nội dung phần header của web-->
      <a href="login.vue" class="block">
        <img src="/images/logo.png" alt="" width="100px" height="100px" />
      </a>
    </header>
    <menuBar></menuBar>
    <section class="flex">
      <!--Nội dung chính của web-->
      <aside class="w-1/4 bg-gray-200 p-4"></aside>
      <article class="flex-1 bg-white p-6">
        <!--Nội dung chính -->
        <carosel></carosel>
        <cowndownClock></cowndownClock>
        <div class="flex flex-col" >
          <div class="grid grid-flow-col grid-col-4 gap-4">
            <h2>Điện thoại</h2>
            
            <div
              v-for="product in phoneProducts"
              :key="product.id"
              class="hover:scale-110 shadow-black hover:shadow-xl ease-in duration-300"
            >
              <img :src="product.src" alt="" width="200px" height="300px" />
              <p class="font-bold text-gray-600">{{ product.title }}</p>
              <p>
                <span class="text-red-600"
                  >Giá {{ formatPrice(product.price) }}</span
                >
              </p>
              <button @click="cart.push(product)" >Them vao gio hang</button>
            </div>
          </div>
           <div class="grid grid-flow-col grid-col-4 gap-4" >
            <h2>Laptop </h2>
            <div
              v-for="product in laptopProducts"
              :key="product.id"
              class="hover:scale-110 shadow-black hover:shadow-xl ease-in duration-300"
            >
              <img :src="product.src" alt="" width="200px" height="300px" />
              <p class="font-bold text-gray-600">{{ product.title }}</p>
              <p>
                <span class="text-red-600"
                  >Giá {{ formatPrice(product.price) }}</span
                >
              </p>
            </div>
          </div>
        </div>
      </article>
      <aside class="w-1/4 bg-gray-200 p-4"></aside>
    </section>
    <footer>
      <!--Nội dung cuối của web (giới thiệu, địa chỉ)-->
      kma@actvn.edu.vn
      <h3>Địa chỉ 141 Chiến thắng - Tân Triều - Thanh Trì - Hà Nội</h3>
    </footer>
  </div>
</template>
<script>
import menuBar from "./baseComponent/menuBar.vue";
import carosel from "./baseComponent/carosel.vue";
import cowndownClock from "./baseComponent/cowdownClock.vue";

export default {
  components: {
    menuBar,
    carosel,
    cowndownClock,
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
      console.log(this.allProducts);
      
      this.phoneProducts = this.allProducts.filter((p) => p.categoryId === 1);
      this.laptopProducts = this.allProducts.filter((p) => p.categoryId === 2);
    },

    formatPrice(value) {
      if (typeof value !== "number") return "N/A";
      return value.toLocaleString("vi-VN");
    },
  },

  mounted() {
    this.loadProduct();
  },
};
</script>