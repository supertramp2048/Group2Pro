<template>
  <div>
    <headerPro></headerPro>

    <div
      class="w-full flex justify-self-center items-center justify-start gap-4 px-4 py-3 border-b border-gray-400"
    >
      
      <h2
        class="text-3xl font-semibold text-gray-800 leading-16 self-center w-full text-center"
      >
        Giỏ hàng của bạn
      </h2>
    </div>
    <div class="w-full max-w-[80%] flex justify-self-center pt-6">
      <button
        @click="clearAllProduct()"
        class="bg-red-700 rounded-[10px] text-xl text-amber-50 p-2 active:bg-red-500"
      >
        Xóa tất cả
      </button>
    </div>
    <div class="checkout-box">
      <ul class="checkout-list">
        <transition-group name="fade">
          <li
            v-for="product in cart"
            :key="product.cart_id"
            class="checkout-product"
          >
            <img :src="product.src" alt="" class="product-image" />
            <h3 class="product-name text-2xl">{{ product.title }}</h3>
            <span class="product-price">{{ formatPrice(product.price) }} </span>

            <button class="product-remove" @click="remove(product.cart_id)">
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
      <router-link
          class="bg-red-700 rounded-[10px] text-xl text-amber-50 w-fit p-3 active:bg-red-500"
          :to="{name: 'bill'}"
        >
          Thanh toan
      </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import useCartStore from "../stores/cartStore";
import headerPro from "./baseComponent/headerPro.vue";
import footerPro from "./baseComponent/footerPro.vue";
import menuBar from "./baseComponent/menuBar.vue";
import MenuBar from "./baseComponent/menuBar.vue";
import FooterPro from "./baseComponent/footerPro.vue";
export default {
  components: { headerPro, MenuBar, FooterPro },
  component: {
    headerPro,
    footerPro,
    menuBar,
  },
  data() {
    return {
      cartStore: useCartStore(),
      ispressed :false
    };
  },
  computed: {
    cart() {
      return this.cartStore.cart; // reactive!
    },
    total() {
      return this.cart.reduce((sum, product) => sum + product.price, 0);
    },
  },
  handleClickClearAllProduct() {
    this.isPressed = true;
    setTimeout(() => {
      this.isPressed = false;
    }, 300); // hiệu ứng 300ms
    this.clearAllProduct();
  },
  created() {
    this.cartStore = useCartStore(); // khai báo store 
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
  
  async mounted() {
    this.cartStore.fetchCart();
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
.active-pressed {
  background-color: #c53030 !important; /* màu đỏ nhạt hơn */
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.4);
  transform: scale(0.96);
  transition: all 0.2s ease;
}
</style>