<template>
    <div>
        <Menu></Menu>
        <h1 style="text-align: center; font-size: 20px;">Manage Users</h1>

        <div v-if="loading" class="text-center text-blue-600">Loading Users...</div>
        <div v-else>
            <button @click="openModal(null)" class="bg-teal-500 text-white px-4 py-2 rounded mb-4">
                Add User
            </button>

            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Username</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Password</th>
                        <th class="border border-gray-300 px-4 py-2">Created Date</th>
                        <th class="border border-gray-300 px-4 py-2">Is Admin</th>
                        <th class="border border-gray-300 px-4 py-2">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ user.id }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ user.userName }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ user.email }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ user.password }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ user.createdDate }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ user.admin ? 'Yes' : 'No' }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button @click="openModal(user)" class="text-teal-500 hover:text-teal-700">Edit</button> |
                            <button @click="deleteUser(user.id)" class="text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Modal -->
            <div v-if="isModalOpen" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded shadow-lg w-1/3">
                    <h2 class="text-xl font-semibold mb-4">{{ isEditing ? 'Edit User' : 'Add User' }}</h2>

                    <form @submit.prevent="handleSubmit">
                        <div class="mb-4">
                            <label for="userName" class="block text-sm font-semibold">Username</label>
                            <input type="text" id="userName" v-model="form.userName"
                                class="w-full p-2 border border-gray-300 rounded" placeholder="Username" required />
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-semibold">Email</label>
                            <input type="email" id="email" v-model="form.email"
                                class="w-full p-2 border border-gray-300 rounded" placeholder="Email" />
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-semibold">Password</label>
                            <input type="text" id="password" v-model="form.password"
                                class="w-full p-2 border border-gray-300 rounded" placeholder="Password" required />
                        </div>

                        <div class="mb-4">
                            <label for="admin" class="block text-sm font-semibold">Admin</label>
                            <select id="admin" v-model="form.admin"
                                class="w-full p-2 border border-gray-300 rounded">
                                <option :value="true">Yes</option>
                                <option :value="false">No</option>
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" @click="closeModal" class="mr-4 text-gray-500">Cancel</button>
                            <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded">
                                {{ isEditing ? 'Save Changes' : 'Add User' }}
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
    components: {
        Menu,
    },
    data() {
        return {
            users: [],
            loading: true,
            error: null,
            isModalOpen: false,
            isEditing: false,
            form: {
                id: null,
                userName: '',
                email: '',
                password: '',
                admin: false,
            },
        };
    },
    mounted() {
        this.fetchUsers();
    },
    methods: {
        async fetchUsers() {
            try {
                const response = await axios.get("http://127.0.0.1:8000/api/users");
                this.users = response.data;
            } catch (error) {
                console.error("Error fetching users:", error);
                this.error = "Failed to load users.";
            } finally {
                this.loading = false;
            }
        },
        async handleSubmit() {
            if (this.isEditing) {
                await this.updateUser();
            } else {
                await this.addUser();
            }
            this.closeModal();
        },
        async addUser() {
            try {
                const response = await axios.post("http://127.0.0.1:8000/api/users", this.form);
                this.users.push(response.data);
            } catch (error) {
                console.error("Error adding user:", error);
            }
        },
        async updateUser() {
            try {
                const response = await axios.put(`http://127.0.0.1:8000/api/users/${this.form.id}`, this.form);
                const index = this.users.findIndex(user => user.id === this.form.id);
                if (index !== -1) {
                    this.users[index] = response.data;
                }
            } catch (error) {
                console.error("Error updating user:", error.response?.data.errors || error.response?.data || error.message);
            }
        },
        openModal(user) {
            if (user) {
                this.isEditing = true;
                this.form = {
                    id: user.id,
                    userName: user.userName,
                    email: user.email,
                    password: user.password,
                    admin: user.admin,
                };
            } else {
                this.isEditing = false;
                this.form = {
                    id: null,
                    userName: '',
                    email: '',
                    password: '',
                    admin: false,
                };
            }
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
        },
        async deleteUser(id) {
            try {
                if (confirm('Are you sure you want to delete this user?')) {
                    await axios.delete(`http://127.0.0.1:8000/api/users/${id}`);
                    this.users = this.users.filter(user => user.id !== id);
                    alert('User deleted successfully.');
                }
            } catch (error) {
                console.error('Error deleting user:', error);
                alert('Failed to delete user.');
            }
        }
    }
};
</script>

<style scoped>
</style>
