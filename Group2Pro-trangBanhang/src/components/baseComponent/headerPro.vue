<template>
  <header
    class="w-full shadow-md bg-gradient-to-r from-red-800 to-red-700 sticky top-0  transition-all duration-300"
  >
    <!-- Thanh trên cùng - ẩn khi scroll -->
    <div
      :class="[
        ' text-white text-sm px-1 py-0 flex justify-between transition-all duration-300 overflow-hidden',
        isScrolled ? 'max-h-0 opacity-0' : 'max-h-20 opacity-100',
      ]"
    ></div>

   
    <!-- Thanh chính: Logo - Search - Cart (compact khi scroll) -->
    <div
      :class="[
        'container w-4/5 mx-auto px-4 flex items-center justify-between transition-all duration-500 ease-in-out',
        isScrolled ? 'py-0' : 'py-0 min-h-[80px]',
      ]"
    >
      <!-- Logo - ẩn khi scroll -->
      <router-link
        :to="{path: '/'}"
        :class="[
          'flex',
          'flex-shrink-0 transition-all duration-500 ease-in-out overflow-hidden',
          isScrolled ? 'w-0 opacity-0 mr-0' : 'w-auto opacity-100 ',
        ]"
      >
        <img
          src="/images/logo.png"
          alt="Logo"
          class="w-[80px] h-[70px] object-contain transition-all duration-500"
        />
      </router-link>
      <div
        :class="[
          'ml-0 text-white italic font-bold  text-2xl transition-all duration-500 ease-in-out mr-14 ',
          isScrolled ? 'opacity-0 w-0' : 'opacity-100 w-auto',
        ]"
      >
       WHALER
      </div>
      <!-- Search - mở rộng khi scroll -->
      <div
        :class="[
          'transition-all duration-500 ease-in-out',
          isScrolled ? 'flex-1' : 'flex-1',
        ]"
      >
        <search class="w-full" />
      </div>

      <!-- Cart - thu nhỏ khi scroll -->
      <div class="flex items-center justify-end ml-10">
        <router-link :to="{ name: 'cart' }" class="relative group scale-100 hover:scale-105 transform ">
         <i class="fa-solid fa-cart-shopping text-3xl"></i>
          <!-- Badge số lượng giỏ hàng -->
          <span
            v-if="cartCount > 0"
            :class="[
              'absolute bg-red-600 text-white font-bold rounded-full flex items-center justify-center shadow-md transition-all duration-500 ease-in-out',
              isScrolled
                ? '-top-2 -right-1 min-w-[16px] h-[16px] text-[10px] px-1'
                : '-top-2 -right-1 min-w-[20px] h-[20px] text-xs px-1',
            ]"
          >
            {{ cartCount }}
          </span>
        </router-link>
      </div>
    </div>
  </header>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted } from "vue";
import search from "./search.vue";
import useCartStore from "../../stores/cartStore";

// Reactive state
const isScrolled = ref(false);
const scrollThreshold = 1; // Giảm ngưỡng scroll để responsive hơn

// Store
const cartStore = useCartStore();

// Computed
const cartCount = computed(() => cartStore.cart.length);

// Scroll handler với throttling để tránh giật
let ticking = false;
const handleScroll = () => {
  if (!ticking) {
    requestAnimationFrame(() => {
      isScrolled.value = window.scrollY > scrollThreshold;
      ticking = false;
    });
    ticking = true;
  }
};

// Lifecycle
onMounted(() => {
  window.addEventListener("scroll", handleScroll, { passive: true });
});

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>

<style scoped>
/* Custom animations */
@keyframes color-change {
  0%,
  100% {
    color: #dc2626;
  }
  50% {
    color: #f59e0b;
  }
}

.animate-color-change {
  animation: color-change 2s infinite;
}

/* Text shadow utility */
.text-shadow-black {
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

/* Đảm bảo scroll mượt mà */
html {
  scroll-behavior: smooth;
}

/* Tối ưu performance cho animations */
.transition-all {
  will-change: transform, opacity, height, width;
}

/* GPU acceleration cho animations */
header * {
  transform: translateZ(0);
}
</style>