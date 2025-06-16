<template>
  <header class="w-full shadow-md bg-white sticky top-0 z-50 transition-all duration-300">
    <!-- Thanh trên cùng - ẩn khi scroll -->
    <div 
      :class="[
        ' text-white text-sm px-1 py-0 flex justify-between transition-all duration-300 overflow-hidden',
        isScrolled ? 'max-h-0 opacity-0' : 'max-h-20 opacity-100'
      ]"
    >
      <div class="text-3xl">
        <img src="/images/logoName.png" class="h-[80px]" alt="Logo Name" />
      </div>
    </div>

    <!-- Thanh thông tin - ẩn khi scroll -->
    <div 
      :class="[
        'bg--50 text-xs text-blue-900 px-4 py-2 flex justify-between items-center transition-all duration-300 overflow-hidden',
        isScrolled ? 'max-h-0 opacity-0' : 'max-h-16 opacity-100'
      ]"
    >
      <div class="flex gap-6">
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
      <div class="px-3 font-semibold whitespace-nowrap text-[13px] text-red-600 animate-pulse">
        🔴 Ngày hội Smember 2025 - Săn deal ngay!
      </div>
    </div>

    <!-- Thanh chính: Logo - Search - Cart (compact khi scroll) -->
    <div 
      :class="[
        'container w-full mx-auto px-4 flex items-center justify-between transition-all duration-500 ease-in-out',
        isScrolled ? 'py-2 min-h-[60px]' : 'py-1 min-h-[80px]'
      ]"
    >
      <!-- Logo - ẩn khi scroll -->
      <div 
        :class="[
          'flex-shrink-0 transition-all duration-500 ease-in-out overflow-hidden',
          isScrolled ? 'w-0 opacity-0 mr-0' : 'w-[200px] opacity-100 mr-4'
        ]"
      >
        <img
          src="/images/logo.png"
          alt="Logo"
          class="w-[180px] h-[80px] object-contain transition-all duration-500"
        />
      </div>

      <!-- Search - mở rộng khi scroll -->
      <div 
        :class="[
          'transition-all duration-500 ease-in-out',
          isScrolled ? 'flex-1' : 'flex-1'
        ]"
      >
        <search class="w-full" />
      </div>

      <!-- Cart - thu nhỏ khi scroll -->
      <div class="flex items-center justify-end ml-4">
        <router-link :to="{ name: 'cart' }" class="relative group">
          <img
            src="/images/cart.png"
            alt="Cart"
            :class="[
              'transition-all duration-500 ease-in-out group-hover:scale-110',
              isScrolled ? 'w-[50px] h-[50px]' : 'w-[80px] h-[80px]'
            ]"
          />
          <!-- Badge số lượng giỏ hàng -->
          <span
            v-if="cartCount > 0"
            :class="[
              'absolute bg-red-600 text-white font-bold rounded-full flex items-center justify-center shadow-md transition-all duration-500 ease-in-out',
              isScrolled 
                ? '-top-1 -right-1 min-w-[16px] h-[16px] text-[10px] px-1' 
                : '-top-1 -right-1 min-w-[20px] h-[20px] text-xs px-1'
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
import { computed, ref, onMounted, onUnmounted } from 'vue'
import search from './search.vue'
import useCartStore from '../../stores/cartStore'

// Reactive state
const isScrolled = ref(false)
const scrollThreshold = 1 // Giảm ngưỡng scroll để responsive hơn

// Store
const cartStore = useCartStore()

// Computed
const cartCount = computed(() => cartStore.cart.length)

// Scroll handler với throttling để tránh giật
let ticking = false
const handleScroll = () => {
  if (!ticking) {
    requestAnimationFrame(() => {
      isScrolled.value = window.scrollY > scrollThreshold
      ticking = false
    })
    ticking = true
  }
}

// Lifecycle
onMounted(() => {
  window.addEventListener('scroll', handleScroll, { passive: true })
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
/* Custom animations */
@keyframes color-change {
  0%, 100% { color: #dc2626; }
  50% { color: #f59e0b; }
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