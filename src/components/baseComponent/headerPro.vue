<template>
  <header>
    <div class="bg-violet-100 leading-10 text-2xl w-full">Da sun kid</div>
    <!--Nội dung phần header của web-->
    <div class="lg:w-4/6 w-full">
      <table class="w-full">
        <tr class="align-middle">
          <td class="w-[200px] p-2">
            <img
              src="/images/logo.png"
              alt="Logo"
              class="object-fill w-[200px] h-[100px] mx-auto"
            />
          </td>
          <td class="px-4">
            <search class="z-50 w-full"></search>
          </td>
          <td class="text-right">
            <router-link :to="{ name: 'cart' }" class="flex justify-end">
              <img
                src="/images/cart.png"
                class="w-[80px] h-[80px] ml-auto"
                alt="Cart"
              />
            </router-link>
          </td>
        </tr>
      </table>
    </div>
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