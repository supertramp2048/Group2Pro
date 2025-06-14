<template>
  <div>
    <Menu />
    <h1 class="text-center text-2xl font-semibold my-4">Manage User Carts</h1>

    <div v-if="loading" class="text-center text-blue-600">Loading User Carts...</div>
    <div v-else>
      <button @click="openModal(null)" class="bg-teal-500 text-white px-4 py-2 rounded mb-4">
        Add User Cart
      </button>

      <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
          <tr class="bg-gray-100 text-left">
            <th class="border border-gray-300 px-4 py-2">ID</th>
            <th class="border border-gray-300 px-4 py-2">User ID</th>
            <th class="border border-gray-300 px-4 py-2">Product ID</th>
            <th class="border border-gray-300 px-4 py-2">Add Date</th>
            <th class="border border-gray-300 px-4 py-2">Manage</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="usercart in usercarts" :key="usercart.id">
            <td class="border border-gray-300 px-4 py-2 text-center">{{ usercart.id }}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{ usercart.userId }}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{ usercart.productId }}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{ usercart.addDate }}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">
              <button @click="openModal(usercart)" class="text-teal-500 hover:text-teal-700">Edit</button> |
              <button @click="deleteUserCart(usercart.id)" class="text-red-500 hover:text-red-700">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Modal -->
      <div v-if="isModalOpen" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
          <h2 class="text-xl font-semibold mb-4">{{ isEditing ? 'Edit User Cart' : 'Add User Cart' }}</h2>
          <form @submit.prevent="handleSubmit">
            <div class="mb-4">
              <label class="block text-sm font-semibold">User ID</label>
              <input type="number" v-model="form.userId" class="w-full p-2 border border-gray-300 rounded" required />
            </div>

            <div class="mb-4">
              <label class="block text-sm font-semibold">Product ID</label>
              <input type="number" v-model="form.productId" class="w-full p-2 border border-gray-300 rounded" required />
            </div>

            <!-- Không có input addDate -->

            <div class="flex justify-end">
              <button type="button" @click="closeModal" class="mr-4 text-gray-500">Cancel</button>
              <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded">
                {{ isEditing ? 'Save Changes' : 'Add Cart' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Menu from '../Includes/Menu.vue';

export default {
  components: { Menu },
  data() {
    return {
      usercarts: [],
      loading: true,
      isModalOpen: false,
      isEditing: false,
      form: {
        id: null,
        userId: '',
        productId: ''
      }
    };
  },
  mounted() {
    this.fetchUserCarts();
  },
  methods: {
    async fetchUserCarts() {
      try {
        const res = await axios.get("http://127.0.0.1:8000/api/cart");
        this.usercarts = res.data;
      } catch (error) {
        console.error("Error fetching carts:", error);
      } finally {
        this.loading = false;
      }
    },
    async handleSubmit() {
      if (this.isEditing) {
        await this.updateUserCart();
      } else {
        await this.addUserCart();
      }
      this.closeModal();
    },
    async addUserCart() {
      try {
        const { userId, productId } = this.form;
        const res = await axios.post("http://127.0.0.1:8000/api/cart", { userId, productId });
        this.usercarts.push(res.data);
      } catch (error) {
        console.error("Error adding user cart:", error);
      }
    },
    async updateUserCart() {
      try {
        const { id, userId, productId } = this.form;
        const res = await axios.put(`http://127.0.0.1:8000/api/cart/${id}`, { userId, productId });
        const index = this.usercarts.findIndex(c => c.id === id);
        if (index !== -1) this.usercarts[index] = res.data;
      } catch (error) {
        console.error("Error updating user cart:", error);
      }
    },
    openModal(cart) {
      if (cart) {
        this.isEditing = true;
        this.form = { id: cart.id, userId: cart.userId, productId: cart.productId };
      } else {
        this.isEditing = false;
        this.form = { id: null, userId: '', productId: '' };
      }
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
    async deleteUserCart(id) {
      if (!confirm("Are you sure you want to delete this cart?")) return;
      try {
        await axios.delete(`http://127.0.0.1:8000/api/cart/${id}`);
        this.usercarts = this.usercarts.filter(c => c.id !== id);
      } catch (error) {
        console.error("Error deleting user cart:", error);
      }
    }
  }
};
</script>

<style scoped>
</style>
