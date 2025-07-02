<template>
  <div class="flex flex-row bg-gradient-to-br from-red-50 to-red-100 min-h-screen">
    <!-- Sidebar -->
    <div class="w-72 min-h-screen flex-shrink-0 bg-white shadow-2xl border-r-4 border-red-700" @click="closeAll">
      <!-- Header với avatar -->
      <div class="bg-gradient-to-r from-red-700 to-red-800 p-6 text-white">
        <div class="flex items-center space-x-3">
          <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-red-700 text-xl font-bold">
            {{ userName.charAt(0).toUpperCase() }}
          </div>
          <div>
            <p class="text-lg font-bold">{{ this.userName }}</p>
            <p class="text-red-200 text-sm">Thành viên</p>
          </div>
        </div>
      </div>

      <!-- Menu navigation -->
      <div class="p-6">
        <h3 class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-4">Menu</h3>
        <ul class="space-y-2">
          <li
            class="cursor-pointer group"
            @click.stop="goToAccount"
          >
            <div class="flex items-center space-x-3 p-4 rounded-xl hover:bg-red-50 hover:border-l-4 hover:border-red-700 transition-all duration-200 group-hover:shadow-md">
              <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-700 transition-colors">
                <span class="text-red-700 group-hover:text-white text-lg">👤</span>
              </div>
              <span class="text-gray-700 font-medium group-hover:text-red-700">Tài khoản</span>
            </div>
          </li>
          <li
            class="cursor-pointer group"
            @click.stop="goToOrders"
          >
            <div class="flex items-center space-x-3 p-4 rounded-xl hover:bg-red-50 hover:border-l-4 hover:border-red-700 transition-all duration-200 group-hover:shadow-md">
              <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-700 transition-colors">
                <span class="text-red-700 group-hover:text-white text-lg">🛒</span>
              </div>
              <span class="text-gray-700 font-medium group-hover:text-red-700">Lịch sử mua hàng</span>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 p-8">
      <!-- Account Information Section -->
      <div class="w-full" v-show="this.acconutOpen">
        <div
          v-if="acconutOpen"
          class="bg-white rounded-2xl shadow-xl border border-red-100 overflow-hidden max-w-2xl mx-auto"
        >
          <!-- Header -->
          <div class="bg-gradient-to-r from-red-700 to-red-800 px-8 py-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
              <span class="mr-3">👤</span>
              Thông tin tài khoản
            </h2>
          </div>
          
          <!-- Content -->
          <div class="p-8">
            <div class="space-y-6">
              <div class="flex items-center p-4 bg-red-50 rounded-xl border-l-4 border-red-700">
                <div class="w-12 h-12 bg-red-700 rounded-lg flex items-center justify-center mr-4">
                  <span class="text-white text-lg">👤</span>
                </div>
                <div>
                  <p class="text-sm text-gray-600 font-medium">Họ tên</p>
                  <p class="text-lg font-semibold text-gray-800">{{ userName }}</p>
                </div>
              </div>
              
              <div class="flex items-center p-4 bg-red-50 rounded-xl border-l-4 border-red-700">
                <div class="w-12 h-12 bg-red-700 rounded-lg flex items-center justify-center mr-4">
                  <span class="text-white text-lg">📧</span>
                </div>
                <div>
                  <p class="text-sm text-gray-600 font-medium">Email</p>
                  <p class="text-lg font-semibold text-gray-800">{{ userEmail }}</p>
                </div>
              </div>
              
              <div class="flex items-center p-4 bg-red-50 rounded-xl border-l-4 border-red-700">
                <div class="w-12 h-12 bg-red-700 rounded-lg flex items-center justify-center mr-4">
                  <span class="text-white text-lg">📅</span>
                </div>
                <div>
                  <p class="text-sm text-gray-600 font-medium">Ngày tạo</p>
                  <p class="text-lg font-semibold text-gray-800">{{ createdDate }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Order History Section -->
      <div class="w-full" v-show="this.orderOpen">
        <div class="max-w-6xl mx-auto">
          <!-- Header -->
          <div class="bg-gradient-to-r from-red-700 to-red-800 rounded-t-2xl px-8 py-6 shadow-lg">
            <h2 class="text-2xl font-bold text-white flex items-center">
              <span class="mr-3">🛒</span>
              Lịch sử đơn hàng
            </h2>
          </div>
          
          <!-- Orders Container -->
          <div class="bg-white rounded-b-2xl shadow-xl border-x border-b border-red-100 p-8">
            <div v-for="order in orders" :key="order.invoice_id" class="order-card">
              <!-- Order Header -->
              <div class="bg-gradient-to-r from-red-50 to-red-100 rounded-xl p-6 mb-6 border-l-4 border-red-700">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="space-y-3">
                    <div class="flex items-center">
                      <span class="w-6 h-6 bg-red-700 rounded-full flex items-center justify-center mr-3">
                        <span class="text-white text-xs">📅</span>
                      </span>
                      <p class="text-gray-700"><strong>Ngày mua:</strong> {{ formatDate(order.created_at) }}</p>
                    </div>
                    <div class="flex items-center">
                      <span class="w-6 h-6 bg-red-700 rounded-full flex items-center justify-center mr-3">
                        <span class="text-white text-xs">👤</span>
                      </span>
                      <p class="text-gray-700"><strong>Người nhận:</strong> {{ order.name }}</p>
                    </div>
                    <div class="flex items-center">
                      <span class="w-6 h-6 bg-red-700 rounded-full flex items-center justify-center mr-3">
                        <span class="text-white text-xs">📞</span>
                      </span>
                      <p class="text-gray-700"><strong>Số điện thoại:</strong> {{ order.phone }}</p>
                    </div>
                  </div>
                  <div class="space-y-3">
                    <div class="flex items-start">
                      <span class="w-6 h-6 bg-red-700 rounded-full flex items-center justify-center mr-3 mt-1">
                        <span class="text-white text-xs">📍</span>
                      </span>
                      <p class="text-gray-700"><strong>Địa chỉ:</strong> {{ order.address }}</p>
                    </div>
                    <div class="flex items-start">
                      <span class="w-6 h-6 bg-red-700 rounded-full flex items-center justify-center mr-3 mt-1">
                        <span class="text-white text-xs">📝</span>
                      </span>
                      <p class="text-gray-700"><strong>Ghi chú:</strong> {{ order.note }}</p>
                    </div>
                    <div class="flex items-center">
                      <span class="w-6 h-6 bg-red-700 rounded-full flex items-center justify-center mr-3">
                        <span class="text-white text-xs">💰 </span>
                      </span>
                      <p class="text-red-700 font-bold text-lg"> <span class="text-gray-700">Tổng tiền :</span> {{ Number(order.total_price).toLocaleString() }}₫</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Products -->
              <div class="mt-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                  <span class="w-8 h-8 bg-red-700 rounded-lg flex items-center justify-center mr-3">
                    <span class="text-white text-sm">📦</span>
                  </span>
                  Sản phẩm đã mua
                </h4>
                <div class="space-y-3">
                  <div
                    v-for="(item, index) in order.items"
                    :key="index"
                    class="product-item-compact"
                  >
                    <img
                      :src="item.product_image"
                      alt="product"
                      class="w-16 h-16 object-cover rounded-lg border border-red-200 flex-shrink-0"
                    />
                    <div class="flex-grow">
                      <h5 class="font-semibold text-gray-800 text-sm mb-1">{{ item.product_name }}</h5>
                      <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-600">Số lượng: x{{ item.quantity }}</span>
                        <span class="text-red-700 font-bold text-sm">{{ Number(item.product_price).toLocaleString() }}₫</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
  border: 2px solid #fee2e2;
  border-radius: 20px;
  padding: 24px;
  margin-bottom: 32px;
  box-shadow: 0 10px 25px rgba(185, 28, 28, 0.1);
  transition: all 0.3s ease-in-out;
  position: relative;
  overflow: hidden;
}

.order-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #b91c1c, #dc2626);
}

.order-card:hover {
  box-shadow: 0 20px 40px rgba(185, 28, 28, 0.15);
  transform: translateY(-2px);
  border-color: #b91c1c;
}

.product-item-compact {
  display: flex;
  align-items: center;
  gap: 12px;
  background: linear-gradient(135deg, #ffffff 0%, #fef2f2 100%);
  border: 1px solid #fee2e2;
  border-radius: 12px;
  padding: 12px;
  transition: all 0.3s ease;
  box-shadow: 0 2px 8px rgba(185, 28, 28, 0.06);
}

.product-item-compact:hover {
  background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
  border-color: #fca5a5;
  box-shadow: 0 4px 15px rgba(185, 28, 28, 0.12);
  transform: translateX(4px);
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Custom scrollbar for better UX */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #fef2f2;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb {
  background: #b91c1c;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #991b1b;
}

/* Animation for loading states */
@keyframes shimmer {
  0% {
    background-position: -200px 0;
  }
  100% {
    background-position: calc(200px + 100%) 0;
  }
}

.loading-shimmer {
  background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
  background-size: 200px 100%;
  animation: shimmer 1.5s infinite;
}
</style>