// src/stores/listStore.js
import { defineStore } from 'pinia'

 const useCartStore = defineStore('cart', {
  state: () => ({
    cart: []
  }),
  actions: {
    addToCart(product) {
     // const found = this.cart.find(product => product.id === product.id)
      const data = {
        productId: product.id
      }
      //console.log(data);
      fetch(`http://localhost:3000/API/cart.php?id=${localStorage.getItem("userId")}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
      // if (found) {
      //   found.qty += 1 // Nếu đã có, tăng số lượng
      // } else {
      //   this.cart.push({ ...product, qty: 1 }) // Nếu chưa có, thêm mới với qty = 1
      // }
    },
    removeFromCart(cart_id) {
      const data = {
        cart_id: cart_id
      }
      console.log(data);
      fetch(`http://localhost:3000/API/cart.php?id=${localStorage.getItem("userId")}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
    },
    clearCart(){
      fetch(`http://localhost:3000/API/cart.php?id=${localStorage.getItem("userId")}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json'
        }
      })
    }
  }

})
export default useCartStore