// src/stores/listStore.js
import { defineStore } from 'pinia'

 const useCartStore = defineStore('cart', {
  state: () => ({
    cart: []
  }),
  actions: {
    addToCart(product) {
      const found = this.cart.find(product => product.id === product.id)

      // if (found) {
      //   found.qty += 1 // Nếu đã có, tăng số lượng
      // } else {
        this.cart.push({ ...product, qty: 1 }) // Nếu chưa có, thêm mới với qty = 1
      // }
    },
    removeFromCart(id){
      this.cart = this.cart.filter(item => item.id !== id)
    },
    clearCart(){
      this.cart = []
    }
  }

})
export default useCartStore