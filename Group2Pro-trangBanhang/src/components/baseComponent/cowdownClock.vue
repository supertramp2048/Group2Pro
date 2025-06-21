<template>
  <div class="flex flex-col items-center p-4 bg-white shadow-md rounded-md max-w-md mx-auto">
    <p class="text-lg font-semibold text-red-600 mb-4">⏰ Countdown to Sale</p>
    <div class="flex space-x-2">
      <div class="flex flex-col items-center">
        <span class="bg-red-700 text-white text-xl font-bold w-12 h-12 flex items-center justify-center rounded-md">
          {{ days }}
        </span>
        <span class="text-xs mt-1 text-gray-600">Days</span>
      </div>
      <div class="flex flex-col items-center">
        <span class="bg-red-700 text-white text-xl font-bold w-12 h-12 flex items-center justify-center rounded-md">
          {{ hours }}
        </span>
        <span class="text-xs mt-1 text-gray-600">Hours</span>
      </div>
      <div class="flex flex-col items-center">
        <span class="bg-red-700 text-white text-xl font-bold w-12 h-12 flex items-center justify-center rounded-md">
          {{ minutes }}
        </span>
        <span class="text-xs mt-1 text-gray-600">Minutes</span>
      </div>
      <div class="flex flex-col items-center">
        <span class="bg-red-700 text-white text-xl font-bold w-12 h-12 flex items-center justify-center rounded-md">
          {{ seconds }}
        </span>
        <span class="text-xs mt-1 text-gray-600">Seconds</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      targetDate: new Date(2025, 5, 20, 0, 0, 0), // 15/06/2025 00:00:00
      days: 0,
      hours: 0,
      minutes: 0,
      seconds: 0,
      timerId: null,
    };
  },
  methods: {
    updateCountdown() {
      const now = new Date();
      const diff = this.targetDate - now;

      if (diff <= 0) {
        // Đếm ngược kết thúc
        this.days = 0;
        this.hours = 0;
        this.minutes = 0;
        this.seconds = 0;
        clearInterval(this.timerId);
      } else {
        this.days = Math.floor(diff / (1000 * 60 * 60 * 24));
        this.hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
        this.minutes = Math.floor((diff / (1000 * 60)) % 60);
        this.seconds = Math.floor((diff / 1000) % 60);
      }
    }
  },
  mounted() {
    this.updateCountdown(); // gọi ngay khi mount
    this.timerId = setInterval(this.updateCountdown, 1000); // cập nhật mỗi giây
  },
  beforeUnmount() {
    clearInterval(this.timerId);
  },
};
</script>
