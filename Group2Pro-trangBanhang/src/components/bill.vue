<template>
  <div>
    <headerPro />

    <!-- Tiêu đề -->
    <div
      class="w-full flex justify-center items-center gap-4 px-4 py-3 border-b border-gray-400"
    >
      <h2 class="text-3xl font-semibold text-gray-800 text-center">
        Thanh toán đơn hàng
      </h2>
    </div>

    <!-- Danh sách sản phẩm -->
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
            <span class="product-price">{{ formatPrice(product.price) }}</span>
            <!-- <button class="product-remove" @click="remove(product.cart_id)">
              X
            </button> -->
            <input
              type="checkbox"
              :value="product"
              v-model="selectedItems"
              class="mr-2 w-5 h-5"
            />
          </li>
        </transition-group>
      </ul>

      <!-- Tổng tiền và form thanh toán -->
      <div
        class="shadow font-bold text-xl w-full flex flex-col gap-6 border border-gray-400 p-6 rounded-xl"
      >
        <p class="text-2xl">
          Tổng số tiền:
          <span class="text-red-600">{{ formatPrice(total) }} đ</span>
        </p>

        <!-- Thông tin người mua -->
        <form @submit.prevent="submitOrder">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input
              type="text"
              v-model="order.username"
              placeholder="Họ và tên"
              required
              class="input"
            />
            <input
              type="text"
              v-model="order.phone"
              placeholder="Số điện thoại"
              required
              class="input"
            />
            <input
              type="text"
              v-model="order.address"
              placeholder="Địa chỉ giao hàng"
              required
              class="input col-span-2"
            />
            <textarea
              v-model="order.note"
              placeholder="Ghi chú"
              rows="3"
              class="input col-span-2"
            ></textarea>
          </div>

          <div class="flex justify-between mt-6">
            <button
              @click="clearAllProduct"
              type="button"
              class="bg-red-600 text-white p-3 rounded-xl hover:bg-red-700"
            >
              Bỏ chọn tất cả
            </button>
            <button
              type="submit"
              class="bg-green-600 text-white p-3 rounded-xl hover:bg-green-700"
            >
              Xác nhận đặt hàng
            </button>
          </div>
        </form>
      </div>
    </div>

    <footerPro />
  </div>
</template>

<script>
import useCartStore from "../stores/cartStore";
import headerPro from "./baseComponent/headerPro.vue";
import footerPro from "./baseComponent/footerPro.vue";

export default {
  components: { headerPro, footerPro },
  data() {
    return {
      cartStore: useCartStore(),
      selectedItems: [],
      order: {
        username: "",
        phone: "",
        address: "",
        note: "",
      },
    };
  },
  computed: {
    cart() {
      return this.cartStore.cart;
    },
    total() {
      return this.selectedItems.reduce(
        (sum, product) => sum + product.price,
        0
      );
    },
  },
  mounted() {
    this.cartStore.fetchCart();
    const selectedItems = history.state.selectedItems;
    this.selectedItems = selectedItems || [];
  },
  methods: {
    remove(id) {
      this.cartStore.removeFromCart(id);
      const selectedItems = history.state.selectedItems;
      this.selectedItems = selectedItems || [];
    },
    clearAllProduct() {
      this.selectedItems = [];
    },
    formatPrice(value) {
      return typeof value === "number" ? value.toLocaleString("vi-VN") : "N/A";
    },
    async submitOrder() {
      if (!this.selectedItems.length) {
        alert("Vui lòng chọn ít nhất một sản phẩm để đặt hàng!");
        return;
      }

      const formData = {
        ...this.order,
        cart: this.selectedItems,
        total: this.total,
      };

      try {
        const res = await fetch("http://localhost/checkout.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(formData),
        });

        const data = await res.json();
        if (data.success) {
          alert("Đặt hàng thành công!");
          this.selectedItems = [];
          this.clearAllProduct();
          this.order = { username: "", phone: "", address: "", note: "" };
        } else {
          alert("Đặt hàng thất bại!");
        }
      } catch (err) {
        alert("Lỗi kết nối tới server!");
        console.error(err);
      }
    },
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
  padding: 0.8em;
  margin: 1em 0;
  list-style: none;
}

.checkout-product * {
  place-self: center;
}

.product-image {
  width: 100px;
  height: auto;
}

.input {
  padding: 0.75em;
  border: 1px solid #ccc;
  border-radius: 10px;
  width: 100%;
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
