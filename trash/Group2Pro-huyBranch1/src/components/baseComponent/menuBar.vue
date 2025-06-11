<template>
  <nav class="bg-gray-800 text-white px-6 py-3 z-30">
    <ul class="flex space-x-6">
      <li v-for="(item, index) in menu" :key="index" class="relative group">
        <router-link
          v-if="!item.children"
          :to="item.route"
          class="hover:bg-gray-700 px-3 py-2 rounded z-30 block"
        >
          {{ item.label }}
        </router-link>
        <button
          v-else
          class="hover:bg-gray-700 px-3 py-2 rounded z-30"
          @click="toggle(index)"
        >
          {{ item.label }}
        </button>

        <!-- Dropdown menu -->
        <ul
          v-if="item.children"
          class="absolute left-0 top-full mt-1 bg-gray-700 rounded shadow-lg min-w-[150px] opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity pointer-events-none group-hover:pointer-events-auto group-focus-within:pointer-events-auto z-30"
          :class="{ block: openIndex === index, hidden: openIndex !== index }"
        >
          <li
            v-for="(child, cIndex) in item.children"
            :key="cIndex"
            class="px-4 py-2 hover:bg-gray-600 cursor-pointer whitespace-nowrap"
          >
            <router-link :to="child.route" class="block w-full">
              {{ child.label }}
            </router-link>
          </li>
        </ul>
      </li>

      <!-- Tài khoản -->
      <li class="relative group ml-auto">
        <button
          class="hover:bg-gray-700 px-3 py-2 rounded z-30"
          @click="toggle(menu.length)"
        >
          Tài khoản
        </button>
        <ul
          class="absolute left-0 top-full mt-1 bg-gray-700 rounded shadow-lg min-w-[150px] opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity pointer-events-none group-hover:pointer-events-auto group-focus-within:pointer-events-auto z-30"
          :class="{ block: openIndex === menu.length, hidden: openIndex !== menu.length }"
        > 
          <li class="px-4 py-2 hover:bg-gray-600 cursor-pointer whitespace-nowrap">
            <router-link to="login" class="block w-full">Đăng nhập</router-link>
          </li>
          <li class="px-4 py-2 hover:bg-gray-600 cursor-pointer whitespace-nowrap" @click="logOut()">Đăng xuất</li>
        </ul>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      openIndex: null,
      menu: [
        { label: "Trang chủ", route: "/" },
        {
          label: "Điện Thoại",
           route: {name: 'allProducts', params: {categoryId: 1} } ,
          
        },
        {
          label: "Camera",
          
        },
        {
          label: "Laptop",
          route: {name: 'allProducts', params: {categoryId: 2} } ,
          
        },
        {
          label: "Dịch vụ",
          children: [
            { label: "Giao hàng tận nhà", route: "/dich-vu/giao-hang" },
            { label: "Tư vấn mua hàng", route: "/dich-vu/tu-van" },
          ],
        },
        { label: "Liên hệ", route: "/lien-he" },
      ],
    };
  },
  methods: {
    toggle(index) {
      this.openIndex = this.openIndex === index ? null : index;
    },
    logOut(){
      localStorage.removeItem("accessToken")
      sessionStorage.removeItem("accessToken")
    }
  },
};
</script>
