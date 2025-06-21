<template>
  <div>
    <div class="hover:bg-gray-200 relative">
      <!-- Nút mở/đóng toàn bộ filter -->
      <img
        src="/images/filterImg.png"
        alt="filter"
        class="w-[50px] h-[50px]"
        @click="filterShow = !filterShow"
      />

      <!-- Khung filter -->
      <div
        v-show="filterShow"
        class="bg-gray-50 w-[600px] h-[500px] absolute right-0 rounded-xl shadow-2xl p-4 overflow-auto z-50"
      >
        <ul>
          <button
            class="bg-red-700 rounded-2xl p-2 text-white mb-3"
            @click="removeChecked()"
          >
            Bỏ chọn tất cả
          </button>
          <li
            v-for="(item, index) in filterOptions"
            :key="index"
            class="text-xl border border-blue-500 rounded-2xl text-center p-4 mb-2 cursor-pointer relative"
          >
            <!-- Mục chính -->
            <div @click="item.showing = !item.showing">
              {{ item.name }}
            </div>

            <!-- Submenu -->
            <ul
              v-show="item.showing"
              class="bg-white mt-2 rounded-lg shadow-xl border border-gray-200"
            >
              <li
                v-for="(child, cIndex) in item.children"
                :key="cIndex"
                class="p-3 border-b last:border-b-0"
                @click="child.checked = !child.checked"
                :class="{ 'bg-blue-200 font-semibold': child.checked }"
              >
                {{ child.subName }}
              </li>
            </ul>
          </li>
        </ul>
        <button
          class="bg-red-700 rounded-2xl p-2 text-white"
          @click="filterProducts()"
        >
          Xem Kết quả
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["allProductObj"],
  data() {
    return {
      filteredProducts: [],
      filterShow: false,
      filterOptions: [
        {
          name: "Giá",
          children: [
            {
              subName: "1 triệu - 3 triệu",
              lowPrice: 1000000,
              highPrice: 3000000,
              checked: false,
            },
            {
              subName: "3 triệu - 5 triệu",
              lowPrice: 3000000,
              highPrice: 5000000,
              checked: false,
            },
            {
              subName: "5 triệu - 9 triệu",
              lowPrice: 5000000,
              highPrice: 9000000,
              checked: false,
            },
            {
              subName: "9 triệu - 20 triệu",
              lowPrice: 9000000,
              highPrice: 20000000,
              checked: false,
            },
            {
              subName: " lớn hơn 20 triệu",
              lowPrice: 20000000,
              checked: false,
            },
          ],
          showing: false,
        },
        {
          name: "Hãng sản xuất",
          children: [
          { subName: "Apple", checked: false },
          { subName: "Dell", checked: false },
          { subName: "Asus", checked: false },
          { subName: "Acer", checked: false },
          { subName: "Samsung", checked: false },
          { subName: "Logitech", checked: false },
          { subName: "Razer", checked: false },
          { subName: "Microsoft", checked: false },
          { subName: "HP", checked: false },
          { subName: "AverMedia", checked: false },
          { subName: "Elgato", checked: false },
          { subName: "Lenovo", checked: false },
          { subName: "Creative", checked: false },
          { subName: "MSI", checked: false },
          { subName: "Huawei", checked: false }
          ],
          showing: false,
        },
        {
          name: "Mới/Cũ",
          children: [
            { subName: "Mới 100%", checked: false },
            { subName: "Đã qua sử dụng", checked: false },
          ],
          showing: false,
        },
      ],
    };
  },
  methods: {
    removeChecked() {
      this.filterOptions.forEach((item) => {
        item.children.forEach((child) => {
          child.checked = false;
        });
      });
      
      // Emit mảng rỗng khi bỏ chọn tất cả
      this.filteredProducts = [];
      this.$emit('filtered-products-changed', this.allProductObj);
    },
    
    filterProducts() {
      const selected = {};

      // Lấy các điều kiện đã chọn
      this.filterOptions.forEach((item) => {
        const checked = item.children.filter((child) => child.checked);
        if (checked.length > 0) {
          selected[item.name] = checked;
        }
      });

      // Kiểm tra xem có điều kiện nào được chọn không
      const hasFilters = Object.keys(selected).length > 0;
      
      if (!hasFilters) {
        // Nếu không có filter nào được chọn, hiển thị tất cả sản phẩm
        this.filteredProducts = this.allProductObj;
      } else {
        // Lọc từ allProductObj
        this.filteredProducts = this.allProductObj.filter((product) => {
          let pass = true;

          // 1. Lọc theo giá
          if (selected["Giá"]) {
            const matches = selected["Giá"].some((range) => {
              const high = range.highPrice ?? Infinity;
              return product.price >= range.lowPrice && product.price <= high;
            });
            if (!matches) pass = false;
          }

          // 2. Lọc theo hãng sản xuất
          if (selected["Hãng sản xuất"]) {
            const brands = selected["Hãng sản xuất"].map((b) => b.subName);
            if (!brands.includes(product.brand)) pass = false;
          }

          // 3. Lọc theo tình trạng (nếu cần)
          // if (selected["Mới/Cũ"]) {
          //   const conditions = selected["Mới/Cũ"].map((c) => c.subName);
          //   if (!conditions.includes(product.condition)) pass = false;
          // }

          return pass;
        });
      }
      
      console.log("Kết quả lọc:", this.filteredProducts);
      
      // Emit mảng đã lọc lên component cha
      this.$emit('filtered-products-changed', this.filteredProducts);
      
      // Đóng filter sau khi lọc
      this.filterShow = false;
    },
  },
};
</script>

<style scoped>
.checkedItem {
  background: rgb(53, 139, 224);
}
</style>