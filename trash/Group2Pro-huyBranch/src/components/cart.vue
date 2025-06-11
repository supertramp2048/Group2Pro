<template>
  <div>
    <headerPro></headerPro>

    <div
      class="w-full max-w-[80%] flex justify-self-center items-center justify-start gap-4 px-4 py-3 border-b border-gray-400"
    >
      <router-link :to="{ name: 'homePage' }" class="text-2xl text-black block">
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
      </router-link>
      <h2
        class="text-3xl font-semibold text-gray-800 leading-16 self-center w-full text-center"
      >
        Giỏ hàng của bạn
      </h2>
    </div>
    <div class="w-full max-w-[80%] flex justify-self-center pt-6">
      <button
        @click="clearAllProduct()"
        class="bg-red-700 rounded-[10px] text-xl text-amber-50 p-2"
      >
        Xóa tất cả
      </button>
    </div>
    <div class="checkout-box">
      <ul class="checkout-list">
        <transition-group name="fade">
          <li
            v-for="product in cart"
            :key="product.id"
            class="checkout-product"
          >
            <img :src="product.src" alt="" class="product-image" />
            <h3 class="product-name text-2xl">{{ product.title }}</h3>
            <span class="product-price">{{ formatPrice(product.price) }} </span>

            <button class="product-remove" @click="remove(product.id)">
              X
            </button>
          </li>
        </transition-group>
      </ul>
      
      <div
        class="shadow-2xs shadow-black font-bold text-2xl w-full  flex justify-self-center items-center  gap-4 px-4 py-3 border border-gray-400 justify-between"
      >
       <p>
          Tổng số tiền
        <span class="text-red-500 font-bold">{{ formatPrice(total) }}</span>
        </p>
      <button
          class="bg-red-700 rounded-[10px] text-xl text-amber-50 p-2 w-fit p-3"
        >
          Thanh toan
      </button>
      </div>
    </div>
    <footerPro></footerPro>
  </div>
</template>

<script>
import useCartStore from "../stores/cartStore"; // import store
import headerPro from "./baseComponent/headerPro.vue";
import footerPro from "./baseComponent/footerPro.vue";
import menuBar from "./baseComponent/menuBar.vue";
import MenuBar from "./baseComponent/menuBar.vue";
import FooterPro from "./baseComponent/footerPro.vue";
export default {
  components: { headerPro, MenuBar, FooterPro },
  data() {
    return {
      cartStore: useCartStore(), // lưu cả store
    };
  },
  computed: {
    cart() {
      console.log("cartStore.cart", this.cartStore.cart);
      return this.cartStore.cart; // reactive!
    },
    total() {
      return this.cart.reduce((sum, product) => sum + product.price, 0);
    },
  },
  methods: {
    remove(data) {
      this.cartStore.removeFromCart(data);
    },
    clearAllProduct() {
      this.cartStore.clearCart();
    },
    formatPrice(value) {
      if (typeof value !== "number") return "N/A";
      return value.toLocaleString("vi-VN");
    },
  },
  mounted() {
    console.log("cartStore.cart", this.cartStore.cart);
  },
};
</script>

<style scoped>
.checkout-box {
  width: 100%;
  max-width: 80%;
  display: flex;
  flex-direction: column;
  margin: 50px auto;
  box-sizing: border-box;
  padding: 1em;
}

.checkout-list {
  padding: 0;
}

.checkout-product {
  display: grid;
  grid-template-columns: 1fr 3fr 2fr 0.5fr;
  background-color: #fff;
  box-shadow: 0px 0px 10px rgba(73, 74, 78, 0.1);
  border-radius: 5px;
  list-style: none;
  box-sizing: border-box;
  padding: 0.8em;
  margin: 1em 0;
}

.checkout-product * {
  place-self: center;
}
.product-image {
  grid-column: 1/2;
  width: 50%;
}

.product-name {
  box-sizing: border-box;
}

.product-price {
  font-size: 1.6em;
  font-weight: bold;
}

.product-remove {
  width: 25px;
  height: 25px;
  border-radius: 50%;
  border: 0;
  background-color: #e0e0e0;
  color: #fff;
  cursor: pointer;
}

.total {
  font-size: 25px;
  font-weight: bold;
}

.checkout-message {
  font-size: 1.5em;
}

.fade-enter-active,
.fade-leave-active {
  transition: all 0.5s;
}

.fade-enter,
.fade-leave-to {
  transform: translateX(-40px);
  opacity: 0;
}
</style>