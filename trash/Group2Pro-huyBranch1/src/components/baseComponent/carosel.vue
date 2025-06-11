<template>
  <div class="relative h-[30vh] md:h-[50vh] w-full mx-0 box-border overflow-hidden">
    <!-- Slide show ảnh -->
    <div class="relative h-full w-full overflow-hidden rounded-lg">
      <div class="absolute inset-0" v-for="(img, index) in images" :key="index">
        <img
          :src="img"
          :alt="`Ảnh ${index + 1}`"
          class="w-full h-full object-cover transition-opacity duration-700"
          :class="currentIndex === index ? 'opacity-100' : 'opacity-0'"
        />
      </div>
    </div>

    <!-- Nút điều hướng -->
    <button
      @click="prevSlide"
      class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-2 z-50"
      aria-label="Ảnh trước"
    >
      ‹
    </button>
    <button
      @click="nextSlide"
      class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-2 z-50"
      aria-label="Ảnh sau"
    >
      ›
    </button>

    <!-- Chỉ mục -->
    <div
      class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-2"
    >
      <span
        v-for="(img, index) in images"
        :key="index"
        class="w-3 h-3 rounded-full cursor-pointer transition-colors duration-200"
        :class="currentIndex === index ? 'bg-white' : 'bg-gray-400'"
        @click="goToSlide(index)"
      ></span>
    </div>
  </div>
</template>
<script>
import { ref } from "vue";

export default {
  name: "Carousel",
  setup() {
    const images = [
      "/images/ads.png",
      "/images/img2.png",
      "/images/img3.png",
      "/images/ads.png",
    ];

    const currentIndex = ref(0);

    const nextSlide = () => {
      currentIndex.value = (currentIndex.value + 1) % images.length;
    };

    const prevSlide = () => {
      currentIndex.value =
        (currentIndex.value - 1 + images.length) % images.length;
    };

    const goToSlide = (index) => {
      currentIndex.value = index;
    };

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