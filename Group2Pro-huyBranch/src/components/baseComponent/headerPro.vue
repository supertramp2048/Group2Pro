<template>
  <header class="w-full shadow-md bg-white">
    <!-- Thanh trên cùng -->
    <div class="bg-blend-color text-white text-sm px-1 py-0 flex justify-between">
      <div class="text-3xl text-shadow-black"><img src="/images/logoName.png"  class=" h-[80px]" alt=""></div>
      
    </div>

    <!-- Thanh chính: Logo - Search - Cart -->
    <div class="container w-full mx-auto px-4 py-3 flex items-center justify-between">
      <!-- Logo -->
      <div class="w-[200px] flex-shrink-0">
        <img
          src="/images/logo.png"
          alt="Logo"
          class="w-[180px] h-[80px] object-contain"
        />
      </div>

      <!-- Search -->
      <div class="flex-1 mx-4">
        <search class="w-full" />
      </div>

      <!-- Cart -->
      <div class="flex items-center justify-end">
        <router-link :to="{ name: 'cart' }" class="relative group">
          <img
            src="/images/cart.png"
            alt="Cart"
            class="w-[80px] h-[80px] transition-transform group-hover:scale-110"
          />
          <!-- Badge số lượng giỏ hàng (nếu có) -->
          <span
            class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full px-1.5"
          >
            "."
          </span>
        </router-link>
      </div>
    </div>
  </header>
</template>

<script>
import search from "./search.vue";

export default {
  components: {
    search,
  },
};
</script>
