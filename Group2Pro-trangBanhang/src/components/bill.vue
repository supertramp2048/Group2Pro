<template>
  <div>
    <headerPro />
    <menubar></menubar>
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
            <input
              type="checkbox"
              :value="product.cart_id"
              v-model="selectedId"
              @change="handleCheckbox($event, product)"
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
              v-model="order.name"
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

    
  </div>
</template>

<script>
import useCartStore from "../stores/cartStore";
import headerPro from "./baseComponent/headerPro.vue";
import footerPro from "./baseComponent/footerPro.vue";
import menubar from "./baseComponent/menuBar.vue"
export default {
  components: { headerPro, footerPro,menubar },
  data() {
    return {
      cartStore: null,
      selectedId: [],
      selectedItems: [],
      order: {
        name: "",
        phone: "",
        address: "",
        note: "",
      },
    };
  },
  created() {
    this.cartStore = useCartStore();
  },
  computed: {
    cart() {
      return this.cartStore.cart;
    },
    total() {
      this.selectedItems = this.cartStore.cart.filter((product) =>
        this.selectedId.includes(product.cart_id)
      );
      return this.selectedItems.reduce(
        (sum, product) => sum + product.price,
        0
      );
    },
  },
  async mounted() {
    try {
      await this.cartStore.fetchCart();
      
      // Khởi tạo selectedId từ buyNowProductId
      if (this.cartStore.buyNowProductId && this.cartStore.buyNowProductId.length > 0) {
        this.selectedId = [...this.cartStore.buyNowProductId];
        console.log('Initialized selectedId from store:', this.selectedId);
      }
    } catch (error) {
      console.error("Lỗi khi khởi tạo trang:", error);
    }
  },

  // Sync selectedId với store khi có thay đổi
  watch: {
    selectedId: {
      handler(newVal, oldVal) {
        console.log('selectedId changed:', newVal);
        
        // Tìm các ID bị xóa
        const removedIds = oldVal.filter(id => !newVal.includes(id));
        removedIds.forEach(id => {
          this.cartStore.removeBuyNowId(id);
        });
        
        // Tìm các ID được thêm
        const addedIds = newVal.filter(id => !oldVal.includes(id));
        addedIds.forEach(id => {
          this.cartStore.setBuyNowId(id);
        });
      },
      deep: true
    }
  },

  methods: {
    clearAllProduct() {
      this.selectedId = [];
      this.cartStore.clearBuyNow(); // Clear store cũng
    },
    formatPrice(value) {
      return typeof value === "number" ? value.toLocaleString("vi-VN") : "N/A";
    },
    async submitOrder() {
      if (!this.selectedItems.length) {
        alert("Vui lòng chọn ít nhất một sản phẩm để đặt hàng!");
        return;
      }

      const name = this.order.name.trim();
      const phone = this.order.phone.trim();
      const address = this.order.address.trim();

      const nameRegex = /^[\p{L} ]+$/u;
      const phoneRegex = /^0[0-9]{9}$/;
      const addressRegex = /^[\p{L}0-9\s,./-]{5,100}$/u;

      if (!nameRegex.test(name)) {
        alert("Họ và tên không hợp lệ (chỉ cho phép chữ và dấu cách)");
        return;
      }

      if (!phoneRegex.test(phone)) {
        alert("Số điện thoại không hợp lệ (phải bắt đầu bằng 0 và có 10 chữ số)");
        return;
      }

      if (!addressRegex.test(address)) {
        alert("Địa chỉ không hợp lệ");
        return;
      }

      const invalidProducts = this.selectedItems.filter(p => p.quantity === 0);
      if (invalidProducts.length > 0) {
        const productNames = invalidProducts.map(p => `- ${p.title}`).join("\n");
        alert(`Các sản phẩm sau đã hết hàng:\n${productNames}\n\nVui lòng bỏ chọn trước khi đặt hàng.`);
        return;
      }


      const formData = {
        user_id: parseInt(localStorage.getItem("userId")), // Lấy từ localStorage
        name: this.order.name,
        phone: this.order.phone,
        address: this.order.address,
        note: this.order.note,
        total_price: this.total.toFixed(2),

        items: this.selectedItems.map((product) => ({
          product_id: product.productId,
          quantity: 1,
        })),
};

 
      try {
        const res = await fetch(`http://localhost:3000/API/invoices.php?userid=${localStorage.getItem("userId")}`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(formData),
        });

        const data = await res.json();
        if (data.success) {
          alert("Đặt hàng thành công!");
          this.selectedId = [];
          this.cartStore.clearBuyNowIds(); // Clear store
          this.order = { username: "", phone: "", address: "", note: "" };
        } else {
          alert("Đặt hàng thất bại!");
        }
      } catch (err) {
        alert("Lỗi kết nối tới server!");
        console.error(err);
      }
    },
    handleCheckbox(event, product) {
      const isChecked = event.target.checked;
      console.log('Checkbox changed:', isChecked, 'Product ID:', product.productId);
      
      // Không cần xử lý logic ở đây vì watcher sẽ tự động sync với store
      if (isChecked) {
        console.log("Đã chọn sản phẩm:", product.cart_id);
      } else {
        console.log("Đã bỏ chọn sản phẩm:", product.cart_id);
      }
    },
  },
  beforeUnmount() {
    this.selectedId = [];
    this.cartStore.clearBuyNow();
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