<template>
  <div class="flex flex-row bg-[url('/images/BgUser.png')] bg-cover bg-center">

   
    <div class="w-64 min-h-screen flex-shrink-0 bg-white shadow-lg p-4" @click="closeAll" >
      <!-- Tên người dùng -->
      <p class="text-xl font-bold mb-6 text-gray-800" @click="closeAll" >👤 {{ this.userName }}</p>

      <!-- Menu danh sách -->
      <ul class="space-y-3">
        <li
          class="cursor-pointer p-3 rounded-lg hover:bg-blue-100 transition"
          @click.stop="goToAccount"
        >
          📄 Tài khoản
        </li>
        <li
          class="cursor-pointer p-3 rounded-lg hover:bg-blue-100 transition"
          @click.stop="goToOrders"
        >
          🛒 Lịch sử mua hàng
        </li>
      </ul>
    </div>
    <div class=" w-full h-screen" v-show="this.acconutOpen">
      <!-- nội dung của tài khoản user chỗ này t mới lấy đc tên user từ localStorage -->
      <div
        v-if="acconutOpen"
        class="bg-white p-6 rounded-lg shadow-md w-full max-w-xl mx-auto "
      >
        <h2 class="text-2xl font-semibold mb-4">Thông tin tài khoản</h2>
        <div class="space-y-3 text-gray-700">
          <p><span class="font-semibold">👤 Họ tên:</span> {{ userName }}</p>
          <p><span class="font-semibold">📧 Email:</span> {{ userEmail }}</p>
          <p><span class="font-semibold">📅 Ngày tạo:</span> {{ createdDate }}</p>
          <p><span class="font-semibold">User ID:</span> {{ userId }}</p>
        </div>
      </div>
    </div>
    <div class=" w-full h-auto px-2 py-8 bg-white" v-show="this.orderOpen">
      <!-- nội dung lịch sử mua hàng chỗ này vì chưa có đơn hàng nên lấy dữ liệu tĩnh ở bên dưới -->
      
      <h2 class="text-2xl font-semibold mb-4">Lịch sử đơn hàng</h2>
      <div v-for="order in orders" :key="order.invoice_id" class="border-b pb-6 mb-6">
        <p><strong>📅 Ngày mua:</strong> {{ formatDate(order.created_at) }}</p>
        <p><strong>👤 Người nhận:</strong> {{ order.name }}</p>
        <p><strong>📞 Số điện thoại:</strong> {{ order.phone }}</p>
        <p><strong>📍 Địa chỉ:</strong> {{ order.address }}</p>
        <p><strong>📝 Ghi chú:</strong> {{ order.note }}</p>
        <p><strong>💰 Tổng tiền:</strong> {{ Number(order.total_price).toLocaleString() }}₫</p>

        <p class="mt-3"><strong>📦 Sản phẩm:</strong></p>
        <ul class="list-none space-y-4 mt-2">
          <li
            v-for="(item, index) in order.items"
            :key="index"
            class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl shadow-sm"
          >
            <img
              :src="item.product_image"
              alt="product"
              class="w-20 h-20 object-cover rounded-lg border"
            />
            <div class="text-gray-800">
              <p class="font-semibold text-lg">{{ item.product_name }}</p>
              <p class="text-sm">Số lượng: x{{ item.quantity }}</p>
              <p class="text-sm">Giá: {{ Number(item.product_price).toLocaleString() }}₫</p>
            </div>
          </li>
        </ul>
      </div>

    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      login: false,
      acconutOpen: false,
      orderOpen: false,
      userName: "",
      userEmail: "",
      userId: "",
      
      createdDate: "",
      //   đây là data giả lập
      orders: [],
    };
  },
  methods: {
    formatDate(datetime) {
      const date = new Date(datetime);
      return date.toLocaleString("vi-VN");
    },

    async loadOders(){
        let res = await fetch(`http://localhost:3000/API/invoices.php?userid=${localStorage.getItem("userId")}`);
        this.orders = await res.json()
        console.log(this.orders);
        
    },
    closeAll(){
    
      this.orderOpen = false;
      this.acconutOpen = false;
    },
    goToAccount() {
      // Ví dụ: sử dụng router
      this.acconutOpen = true;
      this.orderOpen = false;
    },
    goToOrders() {
      this.orderOpen = true;
      this.acconutOpen = false;
    },
    logedIn() {
      const uid = localStorage.getItem("userId");
      const username = localStorage.getItem("username");
      const userEmail = localStorage.getItem("email");
      const id = localStorage.getItem("userId");
      const createdDate = localStorage.getItem("createdDate");
      console.log("date "+createdDate);
      
      if (uid && username) {
        this.login = true;
        this.userId = id;
        this.userName = username;
        this.userEmail = userEmail;
        this.createdDate = createdDate;
      } else {
        this.login = false;
        this.userName = "";
      }
    },
  },
  async mounted() {
    this.logedIn();
    this.loadOders();
  },
};
</script>

<style scoped>
.order-card {
  background-color: #ffffff;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  padding: 24px;
  margin-bottom: 24px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
  transition: box-shadow 0.2s ease-in-out;
}

.order-card:hover {
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
}

.order-header {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 12px;
  color: #1f2937;
}

.order-info {
  font-size: 14px;
  color: #374151;
  margin-bottom: 6px;
}

.order-total {
  font-size: 16px;
  color: #dc2626;
  font-weight: bold;
  margin-top: 10px;
}

.product-item {
  display: flex;
  align-items: center;
  gap: 16px;
  background-color: #f9fafb;
  border-radius: 10px;
  padding: 12px;
  margin-top: 12px;
}

.product-img {
  width: 64px;
  height: 64px;
  object-fit: cover;
  border-radius: 8px;
  border: 1px solid #e5e7eb;
}

.product-details {
  flex-grow: 1;
  color: #1f2937;
}

.product-name {
  font-weight: 600;
  margin-bottom: 4px;
}

.product-meta {
  font-size: 14px;
  color: #6b7280;
}
</style>