<template>
  <div class="flex flex-row">
    <div class="w-64 min-h-screen flex-shrink-0 bg-white shadow-lg p-4">
      <!-- Tên người dùng -->
      <p class="text-xl font-bold mb-6 text-gray-800">👤 {{ this.userName }}</p>

      <!-- Menu danh sách -->
      <ul class="space-y-3">
        <li
          class="cursor-pointer p-3 rounded-lg hover:bg-blue-100 transition"
          @click="goToAccount"
        >
          📄 Tài khoản
        </li>
        <li
          class="cursor-pointer p-3 rounded-lg hover:bg-blue-100 transition"
          @click="goToOrders"
        >
          🛒 Lịch sử mua hàng
        </li>
      </ul>
    </div>
    <div class=" w-full h-screen" v-show="this.acconutOpen">
      <!-- nội dung của tài khoản user chỗ này t mới lấy đc tên user từ localStorage -->
      <div
        v-if="acconutOpen"
        class="bg-white p-6 rounded-lg shadow-md w-full max-w-xl mx-auto"
      >
        <h2 class="text-2xl font-semibold mb-4">Thông tin tài khoản</h2>
        <div class="space-y-3 text-gray-700">
          <p><span class="font-semibold">👤 Họ tên:</span> {{ userName }}</p>
          <p><span class="font-semibold">📧 Email:</span> {{ userEmail }}</p>
          <p><span class="font-semibold">📅 Ngày tạo:</span> {{ createdAt }}</p>
        </div>
      </div>
    </div>
    <div class=" w-full h-auto" v-show="this.orderOpen">
      <!-- nội dung lịch sử mua hàng chỗ này vì chưa có đơn hàng nên lấy dữ liệu tĩnh ở bên dưới -->
      
      <h2 class="text-2xl font-semibold mb-4">Lịch sử đơn hàng</h2>
      <div v-for="order in orders" :key="order.id" class="border-b pb-4 mb-4">
        <p><strong>Mã đơn:</strong> {{ order.id }}</p>
        <p><strong>Ngày mua:</strong> {{ order.date }}</p>
        <p><strong>Trạng thái:</strong> {{ order.status }}</p>
        <p><strong>Tổng tiền:</strong> {{ order.total.toLocaleString() }}₫</p>
        <p class="mt-2"><strong>Sản phẩm:</strong></p>
        <ul class="list-disc ml-6 text-gray-700">
          <li v-for="(item, index) in order.items" :key="index">
            {{ item.name }} (x{{ item.quantity }}) -
            {{ item.price.toLocaleString() }}₫
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
      createDate: "",
      //   đây là data giả lập
      orders: [
        {
          id: "DH001",
          date: "2025-05-20",
          total: 5800000,
          status: "Đã giao",
          items: [
            { name: "iPhone 13", quantity: 1, price: 2000000 },
            { name: "Ốp lưng iPhone", quantity: 1, price: 200000 },
          ],
        },
        {
          id: "DH002",
          date: "2025-05-25",
          total: 13500000,
          status: "Đang giao",
          items: [{ name: "MacBook Air M2", quantity: 1, price: 13500000 }],
        },
        {
          id: "DH003",
          date: "2025-06-02",
          total: 1200000,
          status: "Đã hủy",
          items: [{ name: "Tai nghe Logitech", quantity: 2, price: 600000 }],
        },
        {
          id: "DH004",
          date: "2025-06-10",
          total: 6700000,
          status: "Đã giao",
          items: [
            { name: "Xiaomi Redmi Note 12", quantity: 1, price: 4500000 },
            { name: "Sạc nhanh Xiaomi", quantity: 1, price: 1200000 },
            { name: "Dán màn hình", quantity: 1, price: 100000 },
            { name: "Ốp lưng", quantity: 1, price: 90000 },
          ],
        },
        {
          id: "DH005",
          date: "2025-06-15",
          total: 800000,
          status: "Đang xử lý",
          items: [
            { name: "Chuột Razer Viper Mini", quantity: 1, price: 800000 },
          ],
        },
      ],
    };
  },
  methods: {
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
      if (uid && username) {
        this.login = true;
        this.userName = username;
        this.userEmail = userEmail;
      } else {
        this.login = false;
        this.userName = "";
      }
    },
  },
  async mounted() {
    this.logedIn();
  },
};
</script>
