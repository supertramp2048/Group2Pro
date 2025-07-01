<template>
<div class="justify-items-center  z-30">
  <nav
    class="bg-white  backdrop-blur-lg shadow-2xl w-full lg:w-4/5  px-4 sm:px-6 lg:px-8 py-1 border border-transparent "
    ref="nav"
  >
    <div class="w-full max-w-7xl mx-auto">
      <!-- Mobile Menu Button -->
      <div class="flex items-center justify-between lg:hidden">
        <div class="text-red-500 font-bold text-xl italic">WHALER</div>
        <button
          @click="toggleMobileMenu"
          class="text-black p-2 rounded-lg hover:bg-red-700/30 transition-colors duration-300"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Desktop Menu -->
      <ul class="hidden lg:flex items-center space-x-8">
        <li v-for="(item, index) in menu" :key="index" class="relative group">
          <router-link
            v-if="!item.children"
            :to="item.route"
            class="relative px-4 py-2 text-black font-semibold text-sm uppercase tracking-wide transition-all duration-300 hover:text-red-500 hover:scale-105 rounded-lg hover:bg-white/10 backdrop-blur-sm border border-transparent hover:border-red-400/50 hover:shadow-lg hover:shadow-red-500/25"
          >
            {{ item.label }}
            <span class="absolute inset-x-0 -bottom-1 h-0.5 bg-gradient-to-r from-red-400 to-red-300 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
          </router-link>
          
          <button
            v-else
            class="relative px-4 py-2 text-black font-semibold text-sm uppercase tracking-wide transition-all duration-300 hover:text-red-500 hover:scale-105 rounded-lg hover:bg-white/10 backdrop-blur-sm border border-transparent hover:border-red-400/50 hover:shadow-lg hover:shadow-red-500/25 flex items-center space-x-2"
            @click="toggle(index)"
          >
            <span>{{ item.label }}</span>
            <svg 
              class="w-4 h-4 transition-transform duration-300"
              :class="{ 'rotate-180': openIndex === index }"
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
            <span class="absolute inset-x-0 -bottom-1 h-0.5 bg-gradient-to-r from-red-400 to-red-300 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
          </button>

          <!-- Desktop Dropdown menu -->
          <div
            v-if="item.children"
            class="absolute left-0 top-full mt-2 w-64 transition-all duration-300 transform origin-top"
            :class="openIndex === index ? 'opacity-100 scale-100 translate-y-0' : 'opacity-0 scale-95 -translate-y-2 pointer-events-none'"
          >
            <ul class="bg-white backdrop-blur-xl border border-red-600/30 rounded-xl shadow-2xl shadow-red-500/20 overflow-hidden">
              <li
                v-for="(child, cIndex) in item.children"
                :key="cIndex"
                class="group/item"
              >
                <router-link 
                  :to="child.route" 
                  class="flex items-center px-6 py-4 text-black font-medium transition-all duration-300 hover:text-red-500 hover:bg-gradient-to-r hover:from-red-700/20 hover:to-red-600/20 border-b border-red-700/50 last:border-b-0 hover:border-red-400/30"
                  @click="closeDropdown"
                >
                  <div class="w-2 h-2 bg-red-400 rounded-full mr-3 opacity-0 group-hover/item:opacity-100 transition-opacity duration-300"></div>
                  <span class="relative">
                    {{ child.label }}
                    <span class="absolute inset-x-0 -bottom-1 h-0.5 bg-gradient-to-r from-red-400 to-red-300 transform scale-x-0 group-hover/item:scale-x-100 transition-transform duration-300"></span>
                  </span>
                </router-link>
              </li>
            </ul>
          </div>
        </li>

        <!-- Desktop Tài khoản -->
        <li class="relative ml-auto">
          <button
            class="flex items-center space-x-3 px-6 py-3 bg-gradient-to-r from-red-700 to-red-800 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-red-500/30 border border-red-600/30"
            @click="toggle(menu.length)"
          >
            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
              <i class="fa-solid fa-user text-sm"></i>
            </div>
            <span class="text-sm font-medium">Tài khoản</span>
            <svg 
              class="w-4 h-4 transition-transform duration-300"
              :class="{ 'rotate-180': openIndex === menu.length }"
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          
          <div
            class="absolute right-0 top-full mt-2 w-72 transition-all duration-300 transform origin-top-right"
            :class="openIndex === menu.length ? 'opacity-100 scale-100 translate-y-0' : 'opacity-0 scale-95 -translate-y-2 pointer-events-none'"
          >
            <ul class="bg-gradient-to-br from-red-800 to-red-900 backdrop-blur-xl border border-red-600/30 rounded-xl shadow-2xl shadow-red-500/20 overflow-hidden">
              <li class="group/account border-b border-red-700/50">
                <div v-if="login" class="px-6 py-4">
                  <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center">
                      <i class="fa-solid fa-user text-black text-lg"></i>
                    </div>
                    <div>
                      <p class="text-white font-semibold">{{ userName }}</p>
                      <p class="text-red-200 text-sm">Thành viên</p>
                    </div>
                  </div>
                  <router-link
                    :to="{ name: 'user' }"
                    class="mt-4 block w-full text-center px-4 py-2 bg-gradient-to-r from-red-700/20 to-red-600/20 hover:from-red-800/30 hover:to-red-500 text-red-200  rounded-lg border border-red-600/30 hover:border-red-500/50 transition-all duration-300"
                    @click="closeDropdown"
                  >
                    Xem hồ sơ
                  </router-link>
                </div>
                <div v-else class="px-6 py-4">
                  <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-gray-600 rounded-full flex items-center justify-center">
                      <i class="fa-solid fa-user-slash text-gray-400 text-lg"></i>
                    </div>
                    <div>
                      <p class="text-red-100 font-semibold">Chưa đăng nhập</p>
                      <p class="text-red-300 text-sm">Khách</p>
                    </div>
                  </div>
                  <a
                    href="http://localhost:3000/php/login.php"
                    class="block w-full text-center px-4 py-2 bg-gradient-to-r from-red-700 to-red-800 hover:from-red-800/30 hover:to-red-500 text-white rounded-lg transition-all duration-300 hover:scale-105"
                  >
                    Đăng nhập
                  </a>
                </div>
              </li>
              <li class="group/item">
                <button
                  class="flex items-center w-full px-6 py-4 text-red-200  transition-all duration-300 hover:bg-gradient-to-r hover:from-red-700/20 hover:to-red-500"
                  @click="logOut"
                >
                  <div class="w-8 h-8 bg-red-600/20 rounded-full flex items-center justify-center mr-3 group-hover/item:bg-red-600/30 transition-colors duration-300">
                    <i class="fa-solid fa-sign-out-alt text-red-400 text-sm"></i>
                  </div>
                  <span class="font-medium">Đăng xuất</span>
                </button>
              </li>
            </ul>
          </div>
        </li>
      </ul>

      <!-- Mobile Menu -->
      <div 
        class="lg:hidden mt-4 transition-all duration-300 overflow-hidden"
        :class="mobileMenuOpen ? 'max-h-screen opacity-100' : 'max-h-0 opacity-0'"
      >
        <div class="bg-white backdrop-blur-sm rounded-xl border border-red-700/30 p-4">
          <!-- Mobile Menu Items -->
          <div class="space-y-2">
            <div v-for="(item, index) in menu" :key="index">
              <router-link
                v-if="!item.children"
                :to="item.route"
                class="block px-4 py-3 text-black font-medium rounded-lg hover:bg-red-700/30 transition-colors duration-300"
                @click="closeMobileMenu"
              >
                {{ item.label }}
              </router-link>
              
              <div v-else>
                <button
                  class="flex items-center justify-between w-full px-4 py-3 text-black font-medium rounded-lg hover:bg-red-700/30 transition-colors duration-300"
                  @click="toggleMobileDropdown(index)"
                >
                  <span>{{ item.label }}</span>
                  <svg 
                    class="w-4 h-4 transition-transform duration-300"
                    :class="{ 'rotate-180': mobileDropdownOpen === index }"
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </button>
                
                <!-- Mobile Dropdown -->
                <div 
                  class="ml-4 mt-2 space-y-1 transition-all duration-300 overflow-hidden"
                  :class="mobileDropdownOpen === index ? 'max-h-40 opacity-100' : 'max-h-0 opacity-0'"
                >
                  <router-link
                    v-for="(child, cIndex) in item.children"
                    :key="cIndex"
                    :to="child.route"
                    class="block px-4 py-2 text-red-500 hover:text-black font-medium rounded-lg hover:bg-red-700/20 transition-colors duration-300"
                    @click="closeMobileMenu"
                  >
                    {{ child.label }}
                  </router-link>
                </div>
              </div>
            </div>
          </div>

          <!-- Mobile Account Section -->
          <div class="mt-4 pt-4 border-t border-red-700/30">
            <div v-if="login" class="flex items-center space-x-3 px-4 py-3 bg-red-700/20 rounded-lg">
              <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-user text-black"></i>
              </div>
              <div class="flex-1">
                <p class="text-black font-semibold text-sm">{{ userName }}</p>
                <p class="text-red-500 text-xs">Thành viên</p>
              </div>
            </div>
            
            <div class="mt-3 space-y-2">
              <router-link
                v-if="login"
                :to="{ name: 'user' }"
                class="block px-4 py-2 text-red-400 hover:text-black font-medium rounded-lg hover:bg-red-700/20 transition-colors duration-300"
                @click="closeMobileMenu"
              >
                <i class="fa-solid fa-user-circle mr-2"></i>
                Xem hồ sơ
              </router-link>
              
              <a
                v-else
                href="http://localhost:3000/php/login.php"
                class="block px-4 py-2 text-red-400 hover:text-black font-medium rounded-lg hover:bg-red-700/20 transition-colors duration-300"
              >
                <i class="fa-solid fa-sign-in-alt mr-2"></i>
                Đăng nhập
              </a>
              
              <button
                class="flex items-center w-full px-4 py-2 text-red-400 hover:text-black font-medium rounded-lg hover:bg-red-700/20 transition-colors duration-300"
                @click="logOut"
              >
                <i class="fa-solid fa-sign-out-alt mr-2"></i>
                Đăng xuất
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  </div>
</template>

<script>
import { useUserStore } from "../../stores/user";

export default {
  data() {
    return {
      openIndex: null,
      mobileMenuOpen: false,
      mobileDropdownOpen: null,
      login: false,
      userName: "",
      menu: [
        { label: "Trang chủ", route: "/" },
        { label: "Điện thoại", route: { name: "allProducts", params: { categoryId: 1 } } },
        { label: "Camera", route: { name: "allProducts", params: { categoryId: 3 } } },
        { label: "Laptop", route: { name: "allProducts", params: { categoryId: 2 } } },
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
    toggle(index) {
      this.openIndex = this.openIndex === index ? null : index;
    },
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen;
      if (!this.mobileMenuOpen) this.mobileDropdownOpen = null;
    },
    toggleMobileDropdown(index) {
      this.mobileDropdownOpen = this.mobileDropdownOpen === index ? null : index;
    },
    closeMobileMenu() {
      this.mobileMenuOpen = false;
      this.mobileDropdownOpen = null;
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
    },
  },
  async mounted() {
    const store = useUserStore();
    await store.fetchSession();
    this.logedIn();
  },
};
</script>
