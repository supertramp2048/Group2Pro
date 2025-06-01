<template>
  <header>
    <div class="bg-violet-100 leading-20 text-2xl w-full">Da sun kid</div>
    <!--Nội dung phần header của web-->
    <table class="w-full">
      <tr class="align-middle">
        <td class="w-[100px] p-2">
          <img
            src="/images/logo.png"
            alt="Logo"
            class="w-[300px] h-[100px] object-contain"
          />
        </td>
        <td class="px-4">
          <search class="z-50"></search>
        </td>
        <td>
          <router-link :to="{name: 'cart'}">
            <img src="/images/cart.png" class="w-[80px] h-[80px]" alt="" />
          </router-link>
        </td>
      </tr>
    </table>
  </header>
</template>
<script>
import search from "./search.vue";
export default {
  components: {
    search,
  },
};
</script>