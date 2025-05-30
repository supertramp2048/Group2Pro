<template>
  <div class="relative w-[900px] h-[500px] max-w-7xl  mx-auto  ">
    <!-- Hình ảnh -->
    <div class="overflow-hidden rounded-lg h-full w-full relative ">
      <a href="#">
        <img
          :src="images[currentIndex]"
          alt="carousel image"
          class=" w-full h-full object-cover transition-opacity duration-700 "
        />
      </a>
    </div>

    <!-- Nút điều hướng -->
    <button
      @click="prevSlide"
      class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-2 z-50"
    >
      ‹
    </button>
    <button
      @click="nextSlide"
      class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-2"
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
        class="w-3 h-3 rounded-full cursor-pointer"
        :class="{
          'bg-white': currentIndex === index,
          'bg-gray-400': currentIndex !== index,
        }"
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
      "/images/img1.png",
      "/images/img2.png",
      "/images/img3.png",
      "/images/img1.png",
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
