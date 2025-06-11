// stores/user.js
import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    isLogined: false,
    username: null,
  }),
  actions: {
    async fetchSession() {
      try {
        const res = await fetch("http://localhost:3000/php/session.php", {
          credentials: "include"
        });
        const data = await res.json();
        this.isLogined = data.loggedIn;
        this.username = data.username || null;
      } catch (error) {
        console.error("Lỗi khi gọi API session:", error);
        this.isLogined = false;
        this.username = null;
      }
    }
  }
});
