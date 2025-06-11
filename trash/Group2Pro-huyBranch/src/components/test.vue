<template>
    
</template>
<script>
import useCartStore from "../stores/cartStore"; // import store
export default {
  setup() {
    const cartStore = useCartStore();
    console.log("cartStore.cart", cartStore.cart);
    return { cartStore };
  },
};
</script>