


<template>
   <div class="min-h-screen flex flex-col">
    
    <router-view class="flex flex-col grow"></router-view>
    <footerPro></footerPro>
  </div>
  
</template>
<script>
import footerPro from './components/baseComponent/footerPro.vue';
export default {
  components: {footerPro}
};
</script>
<script setup>
import { onMounted } from 'vue';
import { useUserStore } from './stores/user';
import useCartStore from './stores/cartStore';

const cartStore = useCartStore();
const user = useUserStore();

onMounted(async() => {
  await user.fetchSession(); // đợi lấy user xong
  if (localStorage.getItem("userId")) {
    cartStore.fetchCart();  // gọi sau khi có userId
  }
});

</script>
<style>
html, body {
  height: 100%;
  margin: 0;
}
</style>


