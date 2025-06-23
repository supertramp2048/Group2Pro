<template>
  <nav
    class="bg-white shadow-black drop-shadow-xl w-full sm:w-4/5 self-center text-white px-6 py-3 z-30 justify-items-center"
  >
    <div class="w-full">
      <ul class="flex space-x-6">
        <li v-for="(item, index) in menu" :key="index" class="relative group">
          <router-link
            v-if="!item.children"
            :to="item.route"
            class="hover:bg-gray-200 text-black font-bold px-0 py-2 z-30 block"
          >
            {{ item.label }}
          </router-link>
          <button
            v-else
            class="hover:bg-gray-200 px-3 text-black font-bold py-2 z-30"
            @click="toggle(index)"
          >
            {{ item.label }}
          </button>

          <!-- Dropdown menu -->
          <ul
            v-if="item.children"
            class="absolute left-0 top-full text-black font-bold mt-1 bg-gray-200 shadow-lg min-w-[150px] opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity pointer-events-none group-hover:pointer-events-auto group-focus-within:pointer-events-auto z-30"
            :class="{ block: openIndex === index, hidden: openIndex !== index }"
          >
            <li
              v-for="(child, cIndex) in item.children"
              :key="cIndex"
              class="px-4 py-2 hover:bg-gray-400 text-black font-bold cursor-pointer whitespace-nowrap"
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
            class="hover:bg-gray-200 text-black font-bold px-3 py-2 z-30"
            @click="toggle(menu.length)"
          >
            <i class="fa-solid fa-user"></i>
            Tài khoản
          </button>
          <ul
            class="absolute left-0 top-full mt-1 bg-gray-200 shadow-lg min-w-[150px] opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity pointer-events-none group-hover:pointer-events-auto group-focus-within:pointer-events-auto z-30"
            :class="{
              block: openIndex === menu.length,
              hidden: openIndex !== menu.length,
            }"
          >
            <li
              class="px-4 py-2 text-black font-bold hover:bg-gray-400 cursor-pointer whitespace-nowrap"
            >
              <p v-if="this.login">
                <router-link
                  :to="{ name: 'user' }"
                  class="block w-full h-full"
                  >{{ this.userName }}</router-link
                >
              </p>
              <p v-else>
                <a
                  href="http://localhost:3000/php/login.php"
                  class="block w-full"
                  >Đăng nhập</a
                >
              </p>
            </li>
            <li
              class="px-4 py-2 hover:bg-gray-400 text-black font-bold cursor-pointer whitespace-nowrap"
              @click="logOut()"
            >
              Đăng xuất
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { useUserStore } from "../../stores/user";
export default {
  data() {
    return {
      openIndex: null,
      login: false,
      userName: "",
      menu: [
        { label: "Trang chủ", route: "/" },
        {
          label: "Điện thoại",
          route: { name: "allProducts", params: { categoryId: 1 } },
        },
        {
          label: "Camera",
          route: { name: "allProducts", params: { categoryId: 3 } },
        },
        {
          label: "Laptop",
          route: { name: "allProducts", params: { categoryId: 2 } },
        },
        {
          label: "Dịch vụ",
          children: [
            { label: "Giao hàng tận nhà", route: "/dich-vu/giao-hang" },
            { label: "Tư vấn mua hàng", route: "/about" },
          ],
        },
        { label: "Liên hệ", route: "/contact" },
      ],
    };
  },
  methods: {
    handleLinkClick(route) {
      const current = this.$route;
      const target = this.$router.resolve(route).route;
      console.log("Click router-link:", route);
      if (current.fullPath === target.fullPath) {
        this.$router.go(0); // Reload lại trang nếu route giống nhau
      }
    },
    toggle(index) {
      this.openIndex = this.openIndex === index ? null : index;
    },
    logedIn() {
      const uid = localStorage.getItem("userId");
      const username = localStorage.getItem("username");

      if (uid && username) {
        this.login = true;
        this.userName = username;
      } else {
        this.login = false;
        this.userName = "";
      }
    },
    logOut() {
      localStorage.removeItem("accessToken");
      localStorage.removeItem("userId");
      localStorage.removeItem("username");
      window.location.replace("/");
      fetch("http://localhost:3000/php/logout.php", {
        method: "POST",
        credentials: "include",
      });
      this.login = false;
      this.userName = "";
      console.log("Đã đăng xuất");
    },
  },

  async mounted() {
    const store = useUserStore();
    await store.fetchSession();
    this.logedIn();
  },
};
</script>
