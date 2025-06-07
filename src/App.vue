

<template>
  <div>
    <!-- <router-link :to="{ name: 'homePage' }"> home </router-link> -->
    <router-view></router-view>
  </div>
</template>
<script>
export default {

};
</script>
<script setup>
import { onMounted } from 'vue';
import { useUserStore } from './stores/user';

const user = useUserStore();

onMounted(() => {
  user.fetchSession();
});

</script>

