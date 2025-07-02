<template>
  <div>
    <Menu />
    <h1 class="text-center text-xl font-bold my-4">Manage Invoices</h1>

    <div v-if="loading" class="text-center text-blue-600">Loading invoices...</div>

    <div v-else>
      <div class="mb-4">
        <input
          type="text"
          v-model="searchQuery"
          placeholder="Search by user ID..."
          class="w-full p-2 border border-gray-300 rounded"
        />
      </div>

      <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">User ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Phone</th>
            <th class="border px-4 py-2">Address</th>
            <th class="border px-4 py-2">Note</th>
            <th class="border px-4 py-2">Total</th>
            <th class="border px-4 py-2">Created At</th>
            <th class="border px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="invoice in filteredInvoices" :key="invoice.id">
            <td class="border px-4 py-2 text-center">{{ invoice.id }}</td>
            <td class="border px-4 py-2 text-center">{{ invoice.user_id }}</td>
            <td class="border px-4 py-2 text-center">{{ invoice.name }}</td>
            <td class="border px-4 py-2 text-center">{{ invoice.phone }}</td>
            <td class="border px-4 py-2 text-center">{{ invoice.address }}</td>
            <td class="border px-4 py-2 text-center">{{ invoice.note }}</td>
            <td class="border px-4 py-2 text-center">{{ invoice.total_price }}</td>
            <td class="border px-4 py-2 text-center">{{ invoice.created_at }}</td>
            <td class="border px-4 py-2 text-center">
              <button @click="viewDetails(invoice)" class="text-blue-500 hover:underline">Xem</button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Modal hiển thị sản phẩm trong hóa đơn -->
      <div v-if="selectedInvoice" class="fixed inset-0 bg-gray-700 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white w-3/4 max-w-3xl p-6 rounded shadow-lg overflow-y-auto max-h-[90vh]">
          <h2 class="text-xl font-semibold mb-4">Chi tiết hóa đơn #{{ selectedInvoice.id }}</h2>

          <table class="table-auto w-full border border-gray-300 mb-4">
            <thead>
              <tr class="bg-gray-100">
                <th class="border px-2 py-1">Product ID</th>
                <th class="border px-2 py-1">Title</th>
                <th class="border px-2 py-1">Image</th>
                <th class="border px-2 py-1">Brand</th>
                <th class="border px-2 py-1">Price</th>
                <th class="border px-2 py-1">Quantity</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in selectedInvoice.items" :key="item.id">
                <td class="border px-2 py-1 text-center">{{ item.product_id }}</td>
                <td class="border px-2 py-1 text-center">{{ item.product?.title || 'N/A' }}</td>
                <td class="border px-2 py-1 text-center">
                  <img
                    v-if="item.product?.src"
                    :src="item.product.src"
                    alt="image"
                    class="w-12 h-12 object-cover mx-auto rounded"
                  />
                  <span v-else class="text-gray-400 italic">No Image</span>
                </td>
                <td class="border px-2 py-1 text-center">{{ item.product?.brand || 'N/A' }}</td>
                <td class="border px-2 py-1 text-center">{{ item.product?.price || 0 }}</td>
                <td class="border px-2 py-1 text-center">{{ item.quantity }}</td>
              </tr>
            </tbody>
          </table>

          <div class="flex justify-end">
            <button @click="selectedInvoice = null" class="px-4 py-2 bg-gray-300 rounded">Đóng</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Menu from "../Includes/Menu.vue";

export default {
  components: { Menu },
  data() {
    return {
      invoices: [],
      loading: true,
      searchQuery: '',
      selectedInvoice: null
    };
  },
  mounted() {
    this.fetchInvoices();
  },
  methods: {
    async fetchInvoices() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/invoices");
        this.invoices = response.data;
      } catch (error) {
        console.error("Lỗi khi tải hóa đơn:", error);
      } finally {
        this.loading = false;
      }
    },
    viewDetails(invoice) {
      this.selectedInvoice = invoice;
    },
    async deleteInvoice(id) {
      if (confirm("Bạn chắc chắn muốn xoá hóa đơn này?")) {
        try {
          await axios.delete(`http://127.0.0.1:8000/api/invoices/${id}`);
          this.invoices = this.invoices.filter(inv => inv.id !== id);
        } catch (error) {
          alert("Không thể xoá hóa đơn.");
          console.error(error);
        }
      }
    }
  },
  computed: {
    filteredInvoices() {
      const query = this.searchQuery.toLowerCase();
      return this.invoices.filter(invoice =>
        invoice.user_id.toString().toLowerCase().includes(query)
      );
    }
  }
};
</script>

<style scoped>
</style>
