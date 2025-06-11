<template>
  <div class="relative h-[30vh] md:h-[50vh] w-full lg:w-4/5 mx-0 box-border overflow-hidden">
    <!-- Slide show ảnh -->
    <div class="relative h-full w-full overflow-hidden rounded-lg">
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

    <!-- Nút điều hướng -->
    <button
      @click.stop="prevSlide"
      class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-7 z-[60] hover:bg-opacity-70 transition-all duration-300"
      aria-label="Ảnh trước"
    >
      ‹
    </button>
    <button
      @click.stop="nextSlide"
      class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-7 z-[60] hover:bg-opacity-70 transition-all duration-300"
      aria-label="Ảnh sau"
    >
      ›
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
button:hover {
  background-color: rgba(0, 0, 0, 0.7);
}
</style>