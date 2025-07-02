<template>
  <div >
    <div class="hover:bg-gray-200 relative ">
      <!-- Nút mở/đóng toàn bộ filter -->
      <img
        src="/images/filterImg.png"
        alt="filter"
        class="w-[50px] h-[50px] transition-transform duration-200 hover:scale-110"
        @click="filterShow = !filterShow"
      />

      <!-- Khung filter -->
      <div
        v-show="filterShow"
        class="bg-white w-[500px] h-[600px] absolute right-0 rounded-2xl shadow-2xl border border-gray-200 z-50 overflow-hidden"
      >
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-700 to-red-700 text-white p-4 rounded-t-2xl">
          <h3 class="text-xl font-semibold">Bộ lọc sản phẩm</h3>
        </div>

        <!-- Content -->
        <div class="p-4 h-[480px] overflow-y-auto">
          <!-- Filter Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mb-6">
            <!-- Price & Condition Filters -->
            <div
              v-for="(item, index) in filterOptions"
              :key="index"
              class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200"
            >
              <!-- Header -->
              <div 
                class="bg-gradient-to-r from-blue-50 to-blue-50 p-3 cursor-pointer flex items-center justify-between hover:from-blue-100 hover:to-blue-150 transition-colors duration-200"
                @click="item.showing = !item.showing"
              >
                <span class="font-medium text-gray-700">{{ item.name }}</span>
                <svg 
                  class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
                  :class="{ 'rotate-180': item.showing }"
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>

              <!-- Submenu -->
              <div 
                v-show="item.showing"
                class="max-h-60 overflow-y-auto"
              >
                <div
                  v-for="(child, cIndex) in item.children"
                  :key="cIndex"
                  class="p-3 border-b border-gray-100 last:border-b-0 cursor-pointer hover:bg-blue-50 transition-colors duration-150"
                  @click="child.checked = !child.checked"
                  :class="{ 'bg-blue-100 border-l-4 border-l-blue-500 font-medium': child.checked }"
                >
                  <div class="flex items-center space-x-2">
                    <div 
                      class="w-4 h-4 rounded border-2 border-gray-300 flex items-center justify-center transition-colors duration-150"
                      :class="{ 'bg-blue-500 border-blue-500': child.checked }"
                    >
                      <svg v-if="child.checked" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                      </svg>
                    </div>
                    <span class="text-sm text-gray-700">{{ child.subName }}</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Brand Filter -->
            <div
              v-for="(itemBrand, index) in filterBranch"
              :key="index"
              class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200 md:col-span-2 lg:col-span-1"
            >
              <!-- Header -->
              <div 
                class="bg-gradient-to-r from-blue-50 to-blue-100 p-3 cursor-pointer flex items-center justify-between hover:from-blue-100 hover:to-blue-150 transition-colors duration-200"
                @click="itemBrand.showing = !itemBrand.showing"
              >
                <span class="font-medium text-gray-700">{{ itemBrand.name }}</span>
                <svg 
                  class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
                  :class="{ 'rotate-180': itemBrand.showing }"
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>

              <!-- Brand Submenu -->
              <div 
                v-show="itemBrand.showing"
                class="max-h-60 overflow-y-auto"
              >
                <!-- Category-specific brands -->
                <div v-if="categoryId == 1">
                  <div
                    v-for="(child, cIndex) in itemBrand.children1"
                    :key="cIndex"
                    class="p-3 border-b border-gray-100 last:border-b-0 cursor-pointer hover:bg-blue-50 transition-colors duration-150"
                    @click="child.checked = !child.checked"
                    :class="{ 'bg-blue-100 border-l-4 border-l-blue-500 font-medium': child.checked }"
                  >
                    <div class="flex items-center space-x-2">
                      <div 
                        class="w-4 h-4 rounded border-2 border-gray-300 flex items-center justify-center transition-colors duration-150"
                        :class="{ 'bg-blue-500 border-blue-500': child.checked }"
                      >
                        <svg v-if="child.checked" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <span class="text-sm text-gray-700">{{ child.subName }}</span>
                    </div>
                  </div>
                </div>

                <div v-else-if="categoryId == 2">
                  <div
                    v-for="(child, cIndex) in itemBrand.children2"
                    :key="cIndex"
                    class="p-3 border-b border-gray-100 last:border-b-0 cursor-pointer hover:bg-blue-50 transition-colors duration-150"
                    @click="child.checked = !child.checked"
                    :class="{ 'bg-blue-100 border-l-4 border-l-blue-500 font-medium': child.checked }"
                  >
                    <div class="flex items-center space-x-2">
                      <div 
                        class="w-4 h-4 rounded border-2 border-gray-300 flex items-center justify-center transition-colors duration-150"
                        :class="{ 'bg-blue-500 border-blue-500': child.checked }"
                      >
                        <svg v-if="child.checked" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <span class="text-sm text-gray-700">{{ child.subName }}</span>
                    </div>
                  </div>
                </div>

                <div v-else-if="categoryId == 3">
                  <div
                    v-for="(child, cIndex) in itemBrand.children3"
                    :key="cIndex"
                    class="p-3 border-b border-gray-100 last:border-b-0 cursor-pointer hover:bg-blue-50 transition-colors duration-150"
                    @click="child.checked = !child.checked"
                    :class="{ 'bg-blue-100 border-l-4 border-l-blue-500 font-medium': child.checked }"
                  >
                    <div class="flex items-center space-x-2">
                      <div 
                        class="w-4 h-4 rounded border-2 border-gray-300 flex items-center justify-center transition-colors duration-150"
                        :class="{ 'bg-blue-500 border-blue-500': child.checked }"
                      >
                        <svg v-if="child.checked" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <span class="text-sm text-gray-700">{{ child.subName }}</span>
                    </div>
                  </div>
                </div>

                <div v-else-if="!categoryId">
                  <div
                    v-for="(child, cIndex) in itemBrand.allChildren"
                    :key="cIndex"
                    class="p-3 border-b border-gray-100 last:border-b-0 cursor-pointer hover:bg-blue-50 transition-colors duration-150"
                    @click="child.checked = !child.checked"
                    :class="{ 'bg-blue-100 border-l-4 border-l-blue-500 font-medium': child.checked }"
                  >
                    <div class="flex items-center space-x-2">
                      <div 
                        class="w-4 h-4 rounded border-2 border-gray-300 flex items-center justify-center transition-colors duration-150"
                        :class="{ 'bg-blue-500 border-blue-500': child.checked }"
                      >
                        <svg v-if="child.checked" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <span class="text-sm text-gray-700">{{ child.subName }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer Actions -->
        <div class="bg-gray-50 px-4 py-3 rounded-b-2xl border-t border-gray-200 flex justify-between items-center space-x-3">
          <button
            class="flex-1 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
            @click="filterProducts()"
          >
            🔍 Xem Kết quả
          </button>
          <button
            class="flex-1 bg-gradient-to-r from-gray-400 to-gray-500 hover:from-gray-500 hover:to-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
            @click="removeChecked()"
          >
            🗑️ Bỏ chọn tất cả
          </button>
        </div>
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
          name: "Hãng sản xuất",
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
            { subName: "ASUS", checked: false },
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
              subName: "Lớn hơn 20 triệu",
              lowPrice: 20000000,
              checked: false,
            },
          ],
          showing: false,
        },
        
      ],
    };
  },
  methods: {
    removeChecked() {
      // Reset tất cả filter options
      this.filterOptions.forEach((item) => {
        item.children.forEach((child) => {
          child.checked = false;
        });
      });

      // Reset tất cả brand filters
      this.filterBranch.forEach((brand) => {
        brand.children1.forEach((child) => child.checked = false);
        brand.children2.forEach((child) => child.checked = false);
        brand.children3.forEach((child) => child.checked = false);
        brand.allChildren.forEach((child) => child.checked = false);
      });

      // Emit tất cả sản phẩm
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
      const brandFilter = this.filterBranch[0];
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

          // Lọc theo Hãng sản xuất (so sánh lowercase)
          if (selected["Hãng sản xuất"]) {
            const brands = selected["Hãng sản xuất"].map((b) => b.subName.toLowerCase().trim());
            const productBrand = (product.brand || '').toLowerCase().trim();
            if (!brands.includes(productBrand)) pass = false;
          }

          // Lọc theo Mới/Cũ (so sánh lowercase)
          if (selected["Mới/Cũ"]) {
            const conditions = selected["Mới/Cũ"].map((c) => c.subName.toLowerCase().trim());
            const productCondition = (product.condition || '').toLowerCase().trim();
            if (!conditions.includes(productCondition)) pass = false;
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
/* Custom scrollbar */
.overflow-y-auto::-webkit-scrollbar {
  width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}

/* Animation for smooth transitions */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

.filter-panel {
  animation: fadeIn 0.3s ease-out;
}
</style>