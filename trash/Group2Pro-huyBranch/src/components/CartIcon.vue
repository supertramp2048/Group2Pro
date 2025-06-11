<script setup>
import { computed } from 'vue';
import { useUserStore } from '../stores/user';

const userStore = useUserStore();
const isLogined = computed(() => userStore.isLogined);
</script>

<template>
  <a :href="isLogined ? '/cart' : 'http://localhost:3000/php/login.php'">
    <img src="/images/cart.png" class="w-[80px] h-[80px]" alt="cart" />
  </a>
</template>
