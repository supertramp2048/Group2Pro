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
          <li
            v-for="(itemBrand, index) in filterBranch"
            :key="index"
            class="text-xl border border-blue-500 rounded-2xl text-center p-4 mb-2 cursor-pointer relative"
          >
            <div @click="itemBrand.showing = !itemBrand.showing">
              {{ itemBrand.name }}
            </div>
            <ul
              v-show="itemBrand.showing"
              class="bg-white mt-2 rounded-lg shadow-xl border border-gray-200"
            >
              <div v-if="categoryId == 1">
                <li
                  v-for="(child, cIndex) in itemBrand.children1"
                  :key="cIndex"
                  class="p-3 border-b last:border-b-0"
                  @click="child.checked = !child.checked"
                  :class="{ 'bg-blue-200 font-semibold': child.checked }"
                >
                  {{ child.subName }}
                </li>
              </div>
              <div v-else-if="categoryId == 2">
                <li
                  v-for="(child, cIndex) in itemBrand.children2"
                  :key="cIndex"
                  class="p-3 border-b last:border-b-0"
                  @click="child.checked = !child.checked"
                  :class="{ 'bg-blue-200 font-semibold': child.checked }"
                >
                  {{ child.subName }}
                </li>
              </div>
              <div v-else-if="categoryId == 3">
                <li
                  v-for="(child, cIndex) in itemBrand.children3"
                  :key="cIndex"
                  class="p-3 border-b last:border-b-0"
                  @click="child.checked = !child.checked"
                  :class="{ 'bg-blue-200 font-semibold': child.checked }"
                >
                  {{ child.subName }}
                </li>
              </div>
              <div v-else-if="!categoryId">
                <li
                  v-for="(child, cIndex) in itemBrand.allChildren"
                  :key="cIndex"
                  class="p-3 border-b last:border-b-0"
                  @click="child.checked = !child.checked"
                  :class="{ 'bg-blue-200 font-semibold': child.checked }"
                >
                  {{ child.subName }}
                </li>
              </div>
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
  props: ["allProductObj", "categoryId"],
  data() {
    return {
      filteredProducts: [],
      filterShow: false,
      filterBranch: [
        {
          name: "Hãng sản xuất ",
          type: 10,
          children1: [
            { subName: "Apple", checked: false },
            { subName: "Samsung", checked: false },
            { subName: "Xiaomi", checked: false },
            { subName: "OPPO", checked: false },
            { subName: "ASUS", checked: false },
            { subName: "Google", checked: false },
            { subName: "Vivo", checked: false },
            { subName: "Sony", checked: false },
            { subName: "Realme", checked: false },
            { subName: "Nubia", checked: false },
          ],
          children2: [
            { subName: "Apple", checked: false },
            { subName: "Dell", checked: false },
            { subName: "HP", checked: false },
            { subName: "Lenovo", checked: false },
            { subName: "ASUS", checked: false },
            { subName: "Acer", checked: false },
            { subName: "MSI", checked: false },
            { subName: "Samsung", checked: false },
            { subName: "Huawei", checked: false },
            { subName: "Razer", checked: false },
          ],
          children3: [
            { subName: "Logitech", checked: false },
            { subName: "Razer", checked: false },
            { subName: "Microsoft", checked: false },
            { subName: "Dell", checked: false },
            { subName: "HP", checked: false },
            { subName: "AverMedia", checked: false },
            { subName: "Elgato", checked: false },
            { subName: "Lenovo", checked: false },
            { subName: "ASUS", checked: false },
            { subName: "Creative", checked: false },
          ],
          allChildren: [
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
      ],
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
      this.$emit("filtered-products-changed", this.allProductObj);
    },

    filterProducts() {
      const selected = {};

      // 1. Lọc theo các filter bình thường (Giá, Mới/Cũ)
      this.filterOptions.forEach((item) => {
        const checked = item.children.filter((child) => child.checked);
        if (checked.length > 0) {
          selected[item.name] = checked;
        }
      });

      // 2. Lọc theo hãng sản xuất
      const brandFilter = this.filterBranch[0]; // Chỉ có 1 phần tử
      let brandChildren = [];
      if (this.categoryId == 1) brandChildren = brandFilter.children1;
      else if (this.categoryId == 2) brandChildren = brandFilter.children2;
      else if (this.categoryId == 3) brandChildren = brandFilter.children3;
      else brandChildren = brandFilter.allChildren;
      
      const brandChecked = brandChildren.filter((child) => child.checked);
      if (brandChecked.length > 0) {
        selected["Hãng sản xuất"] = brandChecked;
      }

      const hasFilters = Object.keys(selected).length > 0;

      if (!hasFilters) {
        this.filteredProducts = this.allProductObj;
      } else {
        this.filteredProducts = this.allProductObj.filter((product) => {
          let pass = true;

          // Lọc theo Giá
          if (selected["Giá"]) {
            const matches = selected["Giá"].some((range) => {
              const high = range.highPrice ?? Infinity;
              return product.price >= range.lowPrice && product.price <= high;
            });
            if (!matches) pass = false;
          }

          // Lọc theo Hãng sản xuất
          if (selected["Hãng sản xuất"]) {
            const brands = selected["Hãng sản xuất"].map((b) => b.subName);
            if (!brands.includes(product.brand)) pass = false;
          }

          // Lọc theo Mới/Cũ nếu cần
          if (selected["Mới/Cũ"]) {
            const conditions = selected["Mới/Cũ"].map((c) => c.subName);
            if (!conditions.includes(product.condition)) pass = false;
          }

          return pass;
        });
      }

      console.log("Kết quả lọc:", this.filteredProducts);
      this.$emit("filtered-products-changed", this.filteredProducts);
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