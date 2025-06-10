<template>
  <div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md p-4">
      <h2 class="text-xl font-bold mb-4">Quản lý</h2>
      <ul class="space-y-2">
        <li>
          <button
            @click="currentView = 'add'"
            class="w-full text-left px-4 py-2 rounded hover:bg-blue-100"
          >
            ➕ Thêm
          </button>
        </li>
        <li>
          <button
            @click="currentView = 'edit'"
            class="w-full text-left px-4 py-2 rounded hover:bg-blue-100"
          >
            ✏️ Sửa
          </button>
        </li>
        <li>
          <button
            @click="currentView = 'delete'"
            class="w-full text-left px-4 py-2 rounded hover:bg-blue-100"
          >
            ❌ Xóa
          </button>
        </li>
      </ul>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-6">
      <h1 class="text-2xl font-bold mb-6">Trang Admin</h1>

      <!-- Nội dung từng phần -->
      <div v-if="currentView === 'add'">
        <addForm></addForm>
      </div>

      <div v-if="currentView === 'edit'">
        <fixForm></fixForm>
      </div>

      <div v-if="currentView === 'delete'">
       <delForm></delForm>
      </div>
    </main>
  </div>
</template>
<script>
import addForm from './adminForm/addForm.vue'
import delForm from './adminForm/delForm.vue'
import fixForm from './adminForm/fixForm.vue'
export default {
  components: {
    addForm,
    fixForm,
    delForm
  },
  data() {
    return {
      currentView: 'add', // Giá trị mặc định khi vào trang
    };
  },
};
</script>
