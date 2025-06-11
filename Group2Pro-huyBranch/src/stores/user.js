// stores/user.js
import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    username: null,
  }),
  actions: {
    async fetchSession() {
      try {
        const res = await fetch("http://localhost:3000/php/session.php", {
          credentials: "include"
        });
        const data = await res.json();
        //this.username = data.username || null;
        localStorage.setItem("username", data.username);
        localStorage.setItem("userId", data.userId);
      } catch (error) {
        console.error("Lỗi khi gọi API session:", error); 
        localStorage.setItem("username", null);
      }
    }
  }
});
