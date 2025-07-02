<template>
  <div class="relative w-full mx-1 overflow-hidden">
    <!-- Slide Container -->
    <div
      class="flex transition-transform duration-500 ease-in-out"
      :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
    >
      <div v-for="(slide, index) in slides" :key="index" class="min-w-full">
        <img
          :src="slide.image"
          :alt="slide.title"
          class="w-full object-cover rounded-xl"
        />
      </div>
    </div>

    <!-- Previous Button -->
    <button
      @click="prevSlide"
      class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-500 bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all"
    >
      &#10094;
    </button>

    <!-- Next Button -->
    <button
      @click="nextSlide"
      class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-500 bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all"
    >
      &#10095;
    </button>

    <!-- Dots -->
    <div class="flex justify-center mt-4">
      <span
        v-for="(slide, index) in slides"
        :key="index"
        @click="goToSlide(index)"
        :class="[
          'h-3 w-3 mx-1 rounded-full cursor-pointer transition-all',
          currentIndex === index ? 'bg-gray-800' : 'bg-gray-400',
        ]"
      ></span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    categoryId: {
      type: [String, Number],
      default: 1
    }
  },
  data() {
    return {
      currentIndex: 0,
      slidesByCategory: {
        1: [
          {
            image: '/images/category1/slide1.png',
            title: 'Category 1 - Slide 1'
          },
          {
            image: '/images/category1/slide2.png',
            title: 'Category 1 - Slide 2'
          },
          {
            image: '/images/category1/slide3.png',
            title: 'Category 1 - Slide 3'
          }
        ],
        2: [
          {
            image: '/images/category2/slide1.png',
            title: 'Category 2 - Slide 1'
          },
          {
            image: '/images/category2/slide2.png',
            title: 'Category 2 - Slide 2'
          },
          {
            image: '/images/category2/slide3.png',
            title: 'Category 2 - Slide 3'
          }
        ],
        3: [
          {
            image: '/images/camAds1.png',
            title: 'Category 3 - Slide 1'
          },
          {
            image: '/images/camAds2.png',
            title: 'Category 3 - Slide 2'
          },
          {
            image: '/images/camAds3.png',
            title: 'Category 3 - Slide 3'
          },
          {
            image: '/images/camAds4.png',
            title: 'Category 3 - Slide 3'
          },
        ]
      }
    }
  },
  computed: {
    slides() {
      return this.slidesByCategory[this.categoryId] || this.slidesByCategory[1]
    }
  },
  watch: {
    categoryId() {
      // Reset về slide đầu tiên khi categoryId thay đổi
      this.currentIndex = 0
    }
  },
  methods: {
    nextSlide() {
      this.currentIndex = (this.currentIndex + 1) % this.slides.length
    },
    prevSlide() {
      this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length
    },
    goToSlide(index) {
      this.currentIndex = index
    }
  }
}
</script>

<style scoped>
/* Custom styles nếu cần */
</style>