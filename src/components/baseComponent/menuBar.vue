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
            <router-link to="/logout" class="block w-full">Đăng xuất</router-link>
          </li>
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
        { label: "Trang chủ", route: "/homePage" },
        {
          label: "Điện Thoại",
          children: [
            { label: "Samsung", route: "/dien-thoai/samsung" },
            { label: "Apple", route: "/dien-thoai/apple" },
            { label: "Xiaomi", route: "/dien-thoai/xiaomi" },
            { label: "Oppo", route: "/dien-thoai/oppo" },
            { label: "Bphone", route: "/dien-thoai/bphone" },
            { label: "Google Pixel", route: "/dien-thoai/google-pixel" },
          ],
        },
        {
          label: "Camera",
          children: [
            { label: "Hikvision", route: "/camera/hikvision" },
            { label: "Dahua", route: "/camera/dahua" },
            { label: "Ezviz", route: "/camera/ezviz" },
            { label: "Imou", route: "/camera/imou" },
            { label: "Sony", route: "/camera/sony" },
            { label: "Bosch", route: "/camera/bosch" },
          ],
        },
        {
          label: "Laptop",
          children: [
            { label: "Acer", route: "/laptop/acer" },
            { label: "Apple", route: "/laptop/apple" },
            { label: "Asus", route: "/laptop/asus" },
            { label: "Dell", route: "/laptop/dell" },
            { label: "Hp", route: "/laptop/hp" },
            { label: "Lenovo", route: "/laptop/lenovo" },
          ],
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
  },
};
</script>
