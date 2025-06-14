// src/stores/listStore.js
import { defineStore } from 'pinia'
 const useCartStore = defineStore('cart', {
  state: () => ({
    cart: []
  }),
  actions: { 
    async fetchCart() {
      const response = await fetch(`http://localhost:3000/API/cart.php?id=${localStorage.getItem("userId")}`);
      this.cart = await response.json();
      console.log(localStorage.getItem("userId"));
    },

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
      }).then(() => {
        this.fetchCart(); // 🔁 tải lại dữ liệu
        });
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
        }).then(() => {
        this.fetchCart(); // 🔁 tải lại dữ liệu
        });
    },
    clearCart(){
      fetch(`http://localhost:3000/API/cart.php?id=${localStorage.getItem("userId")}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json'
        }
      }).then(() => {
        this.fetchCart(); // 🔁 tải lại dữ liệu
        });
    }
  }

})

export default useCartStore