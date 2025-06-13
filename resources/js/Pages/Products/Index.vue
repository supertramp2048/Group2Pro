<template>
    <div>
        <Menu></Menu>
        <h1 style="text-align: center;font-size: 20px;">Manage Products</h1>

        <div v-if="loading" class="text-center text-blue-600">Loading Products...</div>
        <div v-else>
            <button @click="openModal(null)" class="bg-teal-500 text-white px-4 py-2 rounded mb-4">
                Add product
            </button>

            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Title</th>
                        <th class="border border-gray-300 px-4 py-2">Image</th>
                        <th class="border border-gray-300 px-4 py-2">Quantity</th>
                        <th class="border border-gray-300 px-4 py-2">Price</th>
                        <th class="border border-gray-300 px-4 py-2">Category</th>
                        <th class="border border-gray-300 px-4 py-2">Description</th>
                        <th class="border border-gray-300 px-4 py-2">Brand</th>
                        <th class="border border-gray-300 px-4 py-2">Manage</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="product in products" :key="product.id">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ product.id }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ product.title }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <img :src="product.src" alt="image" class="w-16 h-16 object-cover mx-auto"
                                v-if="product.src">
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ product.quantity }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ product.price }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ product.category }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ product.description }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ product.brand }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center"> <button @click="openModal(product)"
                                class="text-teal-500 hover:text-teal-700">Edit</button>
                            |
                            <button @click="deleteProduct(product.id)"
                                class="text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>

                </tbody>
            </table>
            <!-- Modal for adding/editing categories -->
            <div v-if="isModalOpen" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded shadow-lg w-1/3">
                    <h2 class="text-xl font-semibold mb-4">{{ isEditing ? 'Edit Product' : 'Add Product' }}</h2>

                    <form @submit.prevent="handleSubmit">
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-semibold">Title</label>
                            <input type="text" id="title" v-model="form.title"
                                class="w-full p-2 border border-gray-300 rounded" placeholder="Product Title"
                                required />
                        </div>

                        <div class="mb-4">
                            <label for="src" class="block text-sm font-semibold">Image URL</label>
                            <input type="text" id="src" v-model="form.src"
                                class="w-full p-2 border border-gray-300 rounded" placeholder="Image Link (src)" />
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-semibold">Quantity</label>
                            <input type="number" id="quantity" v-model.number="form.quantity"
                                class="w-full p-2 border border-gray-300 rounded" placeholder="Product Quantity"
                                required />
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-semibold">Price</label>
                            <input type="number" id="price" v-model.number="form.price"
                                class="w-full p-2 border border-gray-300 rounded" placeholder="Product Price"
                                required />
                        </div>

                        <div class="mb-4">
                            <label for="category" class="block text-sm font-semibold">Category</label>
                            <input type="number" id="category" v-model.number="form.category"
                                class="w-full p-2 border border-gray-300 rounded" placeholder="Category ID" required />
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-semibold">Description</label>
                            <input type="text" id="description" v-model="form.description"
                                class="w-full p-2 border border-gray-300 rounded" placeholder="Product Description" />
                        </div>

                        <div class="mb-4">
                            <label for="brand" class="block text-sm font-semibold">Brand</label>
                            <input type="text" id="brand" v-model="form.brand"
                                class="w-full p-2 border border-gray-300 rounded" placeholder="Product Brand" />
                        </div>

                        <div class="flex justify-end">
                            <button type="button" @click="closeModal" class="mr-4 text-gray-500">Cancel</button>
                            <button type="submit" class="bg-teal-500 text-dark px-4 py-2 rounded">
                                {{ isEditing ? 'Save Changes' : 'Add Product' }}
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
        axios
    },
    data() {
        return {
            products: [],
            loading: true,
            error: null,
            isModalOpen: false, // Modal visibility state
            isEditing: false, // Whether we're editing an existing category
            form: {
                id: null,
                title: '',         // Tên sản phẩm
                src: '',           // Đường dẫn hình ảnh sản phẩm
                quantity: 0,       // Số lượng
                price: 0,          // Giá
                category: 0,       // Danh mục (ID hoặc số)
                description: '',   // Mô tả sản phẩm
                brand: '',
            },
        }

    },
    mounted() {
        this.fetchProducts(); // Fetch categories when component is mounted
    },
    methods: {
        async fetchProducts() {
            try {
                // Make the GET request to the API endpoint
                const response = await axios.get("http://127.0.0.1:8000/api/products");
                this.products = response.data; // Assign data to categories
                console.log(this.products);
            } catch (error) {
                console.error("Error fetching categories:", error);
                this.error = "Failed to load products. Please try again later.";
            } finally {
                this.loading = false; // Stop loading spinner
            }
        },
        async handleSubmit() {
            if (this.isEditing) { //Edit
                await this.updateProduct();
            } else { //Add
                await this.addProduct();
            }
            this.closeModal();
        },
        async addProduct() {
            try {
                const response = await axios.post("http://127.0.0.1:8000/api/products", this.form);
                this.products.push(response.data); // Add new category to local list
            } catch (error) {
                console.error("Error adding product:", error);
            }
        },
        async updateProduct() {
            try {
                const response = await axios.put(`http://127.0.0.1:8000/api/products/${this.form.id}`, this.form);
                const index = this.products.findIndex(product => product.id === this.form.id);
                if (index !== -1) {
                    this.products[index] = response.data; // Update the category in the local list
                }
            } catch (error) {
                console.error("Error updating product:", error);
            }
        },
        openModal(product) {
            if (product) {
                this.isEditing = true;
                this.form = { ...product }; // Pre-fill form for editing
            } else {
                this.isEditing = false;
                this.form = {
                    id: null,
                    title: '',
                    src: '',
                    quantity: 0,
                    price: 0,
                    category: 0,
                    description: '',
                    brand: ''
                };
            }
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
        },
        async deleteProduct(id) {
            try {
                if (confirm('Are you sure you want to delete this product?')) {
                    // Make the DELETE request to the API
                    await axios.delete(`http://127.0.0.1:8000/api/products/${id}`);
                    this.products = this.products.filter(product => product.id !== id); // Remove from local state
                    alert('Product deleted successfully.');
                }
            } catch (error) {
                console.error('Error deleting product:', error);
                alert('Failed to delete product.');
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
