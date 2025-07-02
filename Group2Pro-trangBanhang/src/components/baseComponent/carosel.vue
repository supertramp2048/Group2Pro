<template>
  <div class="carousel-container relative h-auto min-h-[30vh] w-full lg:w-4/5 mx-0 box-border overflow-hidden">
    <!-- Slide show ảnh -->
    <div class="relative h-full  min-h-[30vh] w-full overflow-hidden rounded-lg">
      <div 
        class="absolute inset-0 transition-opacity duration-700" 
        :class="[
          currentIndex === index ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'
        ]"
        v-for="(img, index) in images" 
        :key="index"
      >
        <router-link :to="img.route">
          <img
            :src="img.src"
            :alt="`Ảnh ${index + 1}`"
            class="w-full h-full object-fill"
          />
        </router-link>
      </div>
    </div>
    
    <!-- Nút điều hướng trái -->
    <button
      @click.stop="prevSlide"
      class="nav-button nav-button-left absolute top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-3 z-[60] transition-all duration-300 ease-in-out"
      aria-label="Ảnh trước"
    >
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
    
    <!-- Nút điều hướng phải -->
    <button
      @click.stop="nextSlide"
      class="nav-button nav-button-right absolute top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-3 z-[60] transition-all duration-300 ease-in-out"
      aria-label="Ảnh sau"
    >
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
    
    <!-- Chỉ mục -->
    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-2 z-[60]">
      <span
        v-for="(img, index) in images"
        :key="index"
        class="w-3 h-3 rounded-full cursor-pointer transition-colors duration-200"
        :class="currentIndex === index ? 'bg-white' : 'bg-gray-400'"
        @click.stop="goToSlide(index)"
      ></span>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onBeforeUnmount } from "vue";

export default {
  name: "Carousel",
  setup() {
    const images = [
      { src: "/images/ads.png", route: { name: "productDetail", params: { id: 3 } } },
      { src: "/images/ads2.png", route: { name: "productDetail", params: { id: 1 } } },
      { src: "/images/ads3.png", route: { name: "productDetail", params: { id: 8 } } },
      { src: "/images/ads6.png", route: { name: "productDetail", params: { id: 8 } } },
    ];
    
    const currentIndex = ref(0);
    let intervalId = null;
    
    const nextSlide = () => {
      currentIndex.value = (currentIndex.value + 1) % images.length;
    };
    
    const prevSlide = () => {
      currentIndex.value = (currentIndex.value - 1 + images.length) % images.length;
    };
    
    const goToSlide = (index) => {
      currentIndex.value = index;
    };
    
    onMounted(() => {
      intervalId = setInterval(nextSlide, 5000);
    });
    
    onBeforeUnmount(() => {
      clearInterval(intervalId);
    });
    
    return {
      images,
      currentIndex,
      nextSlide,
      prevSlide,
      goToSlide,
    };
  },
};
</script>

<style scoped>
.carousel-container {
  position: relative;
}

/* Ẩn các nút ban đầu */
.nav-button {
  opacity: 0;
  visibility: hidden;
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Nút trái - trượt từ bên trái */
.nav-button-left {
  left: -60px;
}

/* Nút phải - trượt từ bên phải */
.nav-button-right {
  right: -60px;
}

/* Hiện nút khi hover vào carousel */
.carousel-container:hover .nav-button-left {
  opacity: 1;
  visibility: visible;
  left: 16px;
}

.carousel-container:hover .nav-button-right {
  opacity: 1;
  visibility: visible;
  right: 16px;
}

/* Hiệu ứng hover cho nút */
.nav-button:hover {
  background-color: rgba(0, 0, 0, 0.8);
 /* transform: translateY(-50%) scale(1.1); */
}

/* Đảm bảo transition mượt mà */
.nav-button {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Responsive cho mobile */
@media (max-width: 768px) {
  .nav-button {
    width: 40px;
    height: 40px;
    padding: 2px;
  }
  
  .carousel-container:hover .nav-button-left {
    left: 8px;
  }
  
  .carousel-container:hover .nav-button-right {
    right: 8px;
  }
}
</style>