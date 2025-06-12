<template>
  <header class="w-full shadow-md bg-white">
    <!-- Thanh trên cùng -->
     
    <div class="bg-blend-color text-white text-sm px-1 py-0 flex justify-between">
      <div class="text-3xl text-shadow-black"><img src="/images/logoName.png"  class=" h-[80px]" alt=""></div>
    </div>

    <div class="bg-blend-color text-xs text-blue-900 px-4 py-0 flex justify-between items-center ">
      <div class="flex gap-6 flex-gap">
        <div class="flex items-center gap-1">
          <span class="font-bold">🔒 Chính hãng - Xuất VAT</span>
        </div>
        <div class="flex items-center gap-1">
          <span class="font-bold">🚚 Giao nhanh - Miễn phí</span>
          <span class="text-[11px] text-gray-600">(từ 300K)</span>
        </div>
        <div class="flex items-center gap-1">
          <span class="font-bold">🔁 Thu cũ - Lên đời</span>
        </div>
      </div>
      <div class="px-3 font-semibold whitespace-nowrap text-[13px] animate-color-change">🔴 Ngày hội Smember 2025 - Săn deal ngay!</div>
     </div>

    <!-- Thanh chính: Logo - Search - Cart -->
    <div class="container w-full mx-auto px-4 py-1 flex items-center justify-between">
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
            v-if="cartCount > 0"
            class="absolute -top-[0px] -right-[-1px] min-w-[20px] h-[20px] bg-red-600 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-md px-1"
          >
            {{ cartCount }}
          </span>

        </router-link>
      </div>
    </div>
  </header>
</template>

<script>
import search from "./search.vue";
import { onMounted } from "vue";
export default {
  components: {
    search,
  },
};
</script>
<script setup>
import search from "./search.vue";
import useCartStore from "../../stores/cartStore";
import { computed } from "vue";

// Khởi tạo store
const cartStore = useCartStore();

// Tính số lượng sản phẩm trong giỏ
const cartCount = computed(() => cartStore.cart.length);

</script>