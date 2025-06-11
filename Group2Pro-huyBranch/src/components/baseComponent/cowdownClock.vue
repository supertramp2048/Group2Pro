<template>
  <div class=" flex p-1 lead-[40px] border-b">
    Countdown to Sale: 
    <br>
    <span class="block bg-red-800 w-[30px] h-[30px] m-2 text-amber-50 text-center" > {{ days }}</span> days <span class="block bg-red-800 w-[30px] h-[30px] m-2 text-amber-50 text-center"> {{ hours }} </span> hours 
    <span class="block bg-red-800 w-[30px] h-[30px] m-2 text-amber-50 text-center"> {{ minutes }} </span> minutes <span class="block bg-red-800 w-[30px] h-[30px] m-2 text-amber-50 text-center"> {{ seconds }} </span>  seconds
  </div>
</template>

<script>
export default {
  data() {
    return {
      targetDate: new Date(2025, 5, 15, 0, 0, 0), // 15/06/2025 00:00:00
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
