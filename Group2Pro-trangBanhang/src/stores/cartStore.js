import { defineStore } from 'pinia'

const useCartStore = defineStore('cart', {
  state: () => ({
    cart: [],
    selectedItems: [],
    buyNowProductId: [], // Mảng chứa các ID được chọn từ "Mua ngay"
  }),
  
  getters: {
    // Getter để lấy danh sách sản phẩm đã chọn
    getSelectedProducts: (state) => {
      return state.cart.filter(product => 
        state.buyNowProductId.includes(product.productId)
      );
    }
  },
  
  actions: {
    async fetchCart() {
      try {
        const response = await fetch(`http://localhost:3000/API/cart.php?id=${localStorage.getItem("userId")}`);
        this.cart = await response.json();
        console.log('Cart fetched successfully');
      } catch (error) {
        console.error('Error fetching cart:', error);
      }
    },

    // Thêm ID vào danh sách mua ngay (không trùng lặp)
    setBuyNowId(id) {
      if (!this.buyNowProductId.includes(id)) {
        this.buyNowProductId.push(id);
        console.log('BuyNow ID added:', id, 'Current list:', this.buyNowProductId);
      } else {
        console.log('ID already exists in buyNowProductId:', id);
      }
    },

    // Xóa ID khỏi danh sách mua ngay
    removeBuyNowId(id) {
      const index = this.buyNowProductId.indexOf(id);
      if (index > -1) {
        this.buyNowProductId.splice(index, 1); // ✅ ĐÚNG: sử dụng splice để xóa theo index
        console.log("Removed ID:", id, "Remaining IDs:", this.buyNowProductId);
      } else {
        console.log("ID not found in buyNowProductId:", id);
      }
    },

    // Set chỉ một sản phẩm cho "Mua ngay" (thay thế toàn bộ mảng)
    setSingleBuyNowId(id) {
      this.buyNowProductId = [id];
      console.log('Single BuyNow ID set:', id);
    },

    // Clear toàn bộ danh sách mua ngay
    clearBuyNowIds() {
       for (let i = this.buyNowProductId.length - 1; i >= 0; i--) {
        console.log(this.buyNowProductId[i]);
        this.removeFromCart(this.buyNowProductId[i]);
      }
      this.buyNowProductId = [];
      console.log('All BuyNow IDs cleared');
    },

    // Thêm nhiều IDs vào danh sách mua ngay
    addMultipleBuyNowIds(ids) {
      ids.forEach(id => {
        if (!this.buyNowProductId.includes(id)) {
          this.buyNowProductId.push(id);
        }
      });
      console.log('Multiple BuyNow IDs added:', this.buyNowProductId);
    },

    // Kiểm tra xem một ID có trong danh sách mua ngay không
    isBuyNowSelected(id) {
      return this.buyNowProductId.includes(id);
    },

    async addToCart(product) {
      try {
        const data = {
          productId: product.id
        };
        
        const response = await fetch(`http://localhost:3000/API/cart.php?id=${localStorage.getItem("userId")}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        });

        if (response.ok) {
          await this.fetchCart(); // Tải lại dữ liệu
          console.log('Product added to cart successfully');
        } else {
          console.error('Failed to add product to cart');
        }
      } catch (error) {
        console.error('Error adding to cart:', error);
      }
    },

    async removeFromCart(cart_id) {
      try {
        const data = {
          cart_id: cart_id
        };
        
        const response = await fetch(`http://localhost:3000/API/cart.php?id=${localStorage.getItem("userId")}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        });

        if (response.ok) {
          await this.fetchCart(); // Tải lại dữ liệu
          console.log('Product removed from cart successfully');
        } else {
          console.error('Failed to remove product from cart');
        }
      } catch (error) {
        console.error('Error removing from cart:', error);
      }
    },

    async clearCart() {
      try {
        const response = await fetch(`http://localhost:3000/API/cart.php?id=${localStorage.getItem("userId")}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json'
          }
        });

        if (response.ok) {
          await this.fetchCart(); // Tải lại dữ liệu
          this.clearBuyNowIds(); // Clear luôn buyNowProductId
          console.log('Cart cleared successfully');
        } else {
          console.error('Failed to clear cart');
        }
      } catch (error) {
        console.error('Error clearing cart:', error);
      }
    }
  }
});

export default useCartStore;