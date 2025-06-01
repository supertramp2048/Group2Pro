<template>
  <div>
    <headerPro></headerPro>
    <menuBar></menuBar>
    <div v-for="productObj in product" :key="productObj.id">
      <div
        class="flex items-center justify-between p-6 rounded-2xl bg-gradient-to-r from-pink-500 to-orange-300 text-white w-full max-w-7xl mx-auto shadow-lg h-full"
      >
        <!-- Ảnh sản phẩm -->
        <div class="flex-shrink-0 bg-white rounded-2xl p-4 w-4/12 h-4/12">
          <img
            :src="productObj.src"
            alt="iPhone"
            class="w-auto h-auto object-cover"
          />
        </div>

        <!-- Nội dung mô tả -->
        <div class="flex-1 px-8">
          <h2 class="text-2xl font-bold mb-4">TÍNH NĂNG NỔI BẬT</h2>
          <ul class="space-y-2 text-white text-base list-disc list-inside">
            <li>
              Màn hình Super Retina XDR 6,9 inch lớn hơn có viền mỏng hơn, đem
              đến cảm giác tuyệt vời với khi cầm trên tay.
            </li>
            <li>
              Điều khiển Camera – Chỉ cần trượt ngón tay để điều chỉnh camera
              giúp chụp ảnh hoặc quay video đẹp hoàn hảo và siêu nhanh.
            </li>
            <li>
              iPhone 13 có thiết kế titan cấp 5 với lớp hoàn thiện mới, tinh tế
              được xử lý bề mặt vi điểm.
            </li>
            <li>
              iPhone 13 được cài đặt sẵn hệ điều hành iOS 18, cho giao diện trực
              quan.
            </li>
          </ul>
        </div>
      </div>
      <div class="w-full max-w-7xl mx-auto shadow-lg h-full p-4">
        <h2 class="text-xl font-semibold mb-4">Cam kết sản phẩm</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <!-- Box 1 -->
          <div
            class="flex items-start gap-3 p-4 bg-gray-50 rounded-2xl shadow-sm"
          >
            <div class="bg-red-600 rounded-lg p-2 text-white">
              <!-- Icon điện thoại -->
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 1a11 11 0 100 22 11 11 0 000-22zm0 4a7 7 0 017 7H5a7 7 0 017-7z"
                />
              </svg>
            </div>
            <p class="text-lg text-gray-800">
              Mới, đầy đủ phụ kiện từ nhà sản xuất
            </p>
          </div>

          <!-- Box 2 -->
          <div
            class="flex items-start gap-3 p-4 bg-gray-50 rounded-2xl shadow-sm"
          >
            <div class="bg-red-600 rounded-lg p-2 text-white">
              <!-- Icon shield -->
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 2l7 4v6c0 5.5-3.8 10.7-7 12-3.2-1.3-7-6.5-7-12V6l7-4z"
                />
              </svg>
            </div>
            <p class="text-lg text-gray-800">
              Bảo hành 12 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong
              30 ngày nếu có lỗi phần cứng từ nhà sản xuất.
              <a href="#" class="text-blue-600 font-medium">Xem chi tiết</a>
            </p>
          </div>

          <!-- Box 3 -->
          <div
            class="flex items-start gap-3 p-4 bg-gray-50 rounded-2xl shadow-sm"
          >
            <div class="bg-red-600 rounded-lg p-2 text-white">
              <!-- Icon tag -->
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M7 7l10 10M7 7l5 5m0 0l5-5M5 13l1-1 5 5-1 1-5-5z"
                />
              </svg>
            </div>
            <p class="text-lg text-gray-800">
              Giá sản phẩm <span class="font-bold">đã bao gồm thuế VAT</span>,
              giúp bạn yên tâm và dễ dàng trong việc tính toán chi phí.
            </p>
          </div>
        </div>
      </div>

      <table class="table-fixed border w-full max-w-5xl mx-auto shadow-lg">
        <thead>
          <tr>
            <th class="w-1/3 bg-gray-200 text-left px-2 py-1">
              Thông số kỹ thuật
            </th>
            <th class="w-2/3 bg-gray-200 text-left px-2 py-1">Chi tiết</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="w-1/3 bg-gray-300 px-2 py-1">Kích thước màn hình</td>
            <td class="w-2/3 bg-gray-300 px-2 py-1">10.1 inches</td>
          </tr>
          <tr>
            <td class="bg-gray-300 px-2 py-1">Kích thước màn hình</td>
            <td class="bg-gray-300 px-2 py-1">10.1 inches</td>
          </tr>
          <tr>
            <td class="bg-gray-300 px-2 py-1">Kích thước màn hình</td>
            <td class="bg-gray-300 px-2 py-1">10.1 inches</td>
          </tr>
          <tr>
            <td class="bg-gray-300 px-2 py-1">Kích thước màn hình</td>
            <td class="bg-gray-300 px-2 py-1">10.1 inches</td>
          </tr>
          <tr>
            <td class="bg-gray-300 px-2 py-1">Kích thước màn hình</td>
            <td class="bg-gray-300 px-2 py-1">10.1 inches</td>
          </tr>
          <!-- Thêm dòng nếu cần -->
        </tbody>
      </table>

      <!-- Cha bao ngoài để canh giữa thanh -->
      <div class="sticky bottom-0 left-0 flex justify-center z-50">
        <!-- Thanh mua hàng -->
        <div
          class="w-full max-w-7xl mx-auto shadow-lg md:w-8/12 bg-white px-4 py-3 flex items-center justify-between rounded-t-xl"
        >
          <!-- Hình ảnh + tên sản phẩm -->
          <div class="flex items-center gap-3 overflow-hidden">
            <img
              :src="productObj.src"
              alt="iPhone"
              class="w-24 h-24 object-cover rounded-md"
            />
            <div class="text-black font-semibold text-sm truncate w-full">
              {{ productObj.title }}
            </div>
          </div>

          <!-- Giá tiền -->
          <div class="flex flex-col items-end mr-4">
            <span class="text-red-600 font-bold text-lg">{{
              formatPrice(productObj.price)
            }}</span>
            <span class="text-gray-400 line-through text-sm">34.990.000₫</span>
          </div>

          <!-- Các nút -->
          <div class="flex items-center gap-2">
            <button
              class="border border-blue-600 text-blue-600 px-3 py-1 rounded-md text-sm font-medium"
            >
              Trả góp 0%
            </button>
            <button
              class="bg-red-600 text-white px-4 py-2 rounded-md font-semibold"
            >
              Mua Ngay
            </button>
            <button
              @click="addProduct(productObj)"
              class="bg-transparent hover:bg-red-600 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-md"
            >
              Them vao gio hang
            </button>
          </div>
        </div>
      </div>
    </div>
    <footerPro></footerPro>
  </div>
</template>
<script>
import headerPro from "./baseComponent/headerPro.vue";
import menuBar from "./baseComponent/menuBar.vue";
import footerPro from "./baseComponent/footerPro.vue";
import useCartStore from "../stores/cartStore";
export default {
  props: ["id"],
  data() {
    return {
      product: {},
      cartStore: null,
    };
  },
  created() {
    this.cartStore = useCartStore();
  },
  components: {
    headerPro,
    menuBar,
    footerPro,
  },
  computed: {
    cart() {
      return this.cartStore.cart; // reactive!
    },
  },
  methods: {
    async loadProduct(data) {
      let res = await fetch(`http://localhost:3000/posts?id=${this.id}`);
      const dataObj = await res.json();
      this.product = dataObj;
    },
    formatPrice(value) {
      if (typeof value !== "number") return "N/A";
      return value.toLocaleString("vi-VN");
    },
    addProduct(product) {
      this.cartStore.addToCart(product); // gọi action thêm sp vào giỏ (theo tên action trong store)
      console.log(this.cartStore.cart); // in ra giỏ hàng để kiểm tra
    },
  },
  mounted() {
    this.loadProduct();
  },
};
</script>
<style scoped>
td {
  border: 1px solid rgb(240, 236, 236);
  background: rgb(210, 207, 207);
}
</style>