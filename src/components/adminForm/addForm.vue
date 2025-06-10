<template>
  <div>
    <h2 class="text-xl font-semibold mb-2">Thêm sản phẩm</h2>
    <!-- Form thêm -->
    <div class="bg-green-400 absolute" v-show="notifycation">Them san pham thanh cong</div>
    <form class="max-w-md mx-auto" @submit.prevent="addProduct">
      <div class="relative z-0 w-full mb-5 group">
        <input
          type="text"
          name="name"
          id="name"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" "
          required
          v-model="title"
        />
        <label
          for="name"
          class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        >
          Tên sản phẩm
        </label>
      </div>

      <div class="relative z-0 w-full mb-5 group">
        <input
          type="text"
          name="price"
          id="price"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" "
          required
          v-model="price"
        />
        <label
          for="price"
          class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        >
          Gía sản phẩm
        </label>
      </div>

      <div class="relative z-0 w-full mb-5 group">
        <input
          type="text"
          name="brand"
          id="brand"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" "
          required
          v-model="brand"
        />
        <label
          for="brand"
          class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        >
          Hãng sản xuất
        </label>
      </div>

      <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <input
            type="text"
            name="id"
            id="id"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" "
            required
            v-model="id"
          />
          <label
            for="id"
            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
          >
            ID
          </label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
          <select
            id="category"
            name="category"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            v-model="categoryId"
          >
            <option selected>Phân loại</option>
            <option value="1">Điện thoại</option>
            <option value="2">Laptop</option>
            <option value="3">Camera</option>
          </select>
        </div>
      </div>

      <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <input
            type="text"
            name="src"
            id="src"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" "
            required
            v-model="src"
          />
          <label
            for="src"
            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
          >
            Đường dẫn ảnh
          </label>
        </div>
      </div>

      <button
        type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
      >
        Submit
      </button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      id: "",
      title: "",
      src: "",
      price: "",
      categoryId: null,
      brand: "",
      notifycation: false
    };
  },
  methods: {
    async addProduct() {
      try {
        const response = await axios.post(
          "http://localhost:3000/posts",
          { 
            id: this.id,
            title: this.title,
            src: this.src,
            price: this.price,
            categoryId : this.categoryId,
            brand: this.brand
          },
          this.token
            ? {
                headers: {
                  Authorization: `Bearer ${this.token}`,
                },
              }
            : {}
        );
        this.notifycation = true
        setTimeout(() => {
            this.notifycation = false
        }, 1200); 
        console.log("✅ Đã thêm sản phẩm:", response.data);
      } catch (error) {
        console.error("❌ Lỗi khi thêm sản phẩm:", error);
      }
    },
  },
};
</script>
