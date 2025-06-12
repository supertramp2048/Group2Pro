<template>
  <div class="w-4/6 flex relative z-50" ref="searchWrapper">
    <form @submit.prevent="showResult()" class="w-full">
      <div class="relative w-full">
        <input
          type="text"
          class="block w-full h-12 text-xl pl-4 pr-10 font-medium text-white border border-amber-50 bg-blend-color-burn rounded-2xl placeholder-gray-200"
          placeholder="Tìm kiếm sản phẩm công nghệ..."
          v-model="keySearch"
          @focus="onFocus"
        />
        <button
          type="submit"
          class="absolute right-2 top-1/2 -translate-y-1/2 text-white   bg-sky-500 hover:bg-sky-600 rounded-2xl px-4 py-1"
        >
          Tìm
        </button>
      </div>
    </form>

    <!-- Dropdown suggestions -->
    <div
      v-if="isFocused && recomendData.length"
      class="absolute top-full left-0 flex flex-col w-full z-50 max-h-60 overflow-y-auto bg-gray-800 shadow-lg rounded-b-lg"
    >
      <div
        v-for="object in recomendData"
        :key="object.id"
        class="block px-4 py-2 text-lg text-white hover:bg-gray-700 cursor-pointer border-b border-gray-700 last:border-b-0"
        @click="selectSuggestion(object)"
      >
        {{ object.title }}
      </div>
    </div>
  </div>
</template>


<script>
import searchList from "./searchList.vue";
import searchStore from "../../stores/searchStore";

export default {
  components: {
    searchList,
  },
  
  data() {
    return {
      isFocused: false,
      keySearch: "",
      searchStore: null,
      recomendData: [],
      searchList: [],
      searchTimeout: null, // Thêm debounce
    };
  },

  created() {
    this.searchStore = searchStore();
  },

  watch: {
    keySearch: {
      handler() {
        // Debounce search để tránh gọi API quá nhiều
        clearTimeout(this.searchTimeout);
        this.searchTimeout = setTimeout(() => {
          this.getSearchData();
        }, 300); // Delay 300ms
      },
      immediate: false
    },
    
  },


  methods: {
    async loadData() {
      try {
        let res = await fetch(`http://localhost:3000/API/index.php`);
        if (!res.ok) {
          throw new Error(`HTTP error! status: ${res.status}`);
        }
        this.searchList = await res.json();
      } catch (error) {
        console.error('Error loading data:', error);
        this.searchList = [];
      }
    },

    async getSearchData() {
      // Load data if not already loaded
      if (this.searchList.length === 0) {
        await this.loadData();
      }
      
      if (this.keySearch.trim() === "") {
        this.recomendData = [];
      } else {
        this.recomendData = this.searchList.filter((item) =>
          item.title?.toLowerCase().includes(this.keySearch.toLowerCase())
        );
        
        // Limit suggestions to prevent performance issues
        this.recomendData = this.recomendData.slice(0, 10);
      }
    },

    async onFocus() {
      this.isFocused = true;
      // Load data on first focus if needed
      if (this.searchList.length === 0) {
        await this.loadData();
      }
      // Only search if there's already text
      if (this.keySearch.trim()) {
        this.getSearchData();
      }
    },

    handleClickOutside(event) {
      const wrapper = this.$refs.searchWrapper;
      if (wrapper && !wrapper.contains(event.target)) {
        this.isFocused = false;
      }
    },

    showResult() {
     // console.log("Search triggered with keyword:", this.keySearch);
     // console.log("Recommend data:", this.recomendData);
      
      // Nếu không có từ khóa tìm kiếm, không làm gì
      if (!this.keySearch.trim()) {
        return;
      }

      // Set results vào store
      this.searchStore.setResults(this.recomendData);
     // console.log("setResults called with:", this.searchStore.results);
      
      // Đóng dropdown
      this.isFocused = false;
      
      // Navigate to search results page
      this.$router.push("/searchResult");
    },

    selectSuggestion(object) {
     // console.log("Selected suggestion:", object);
      this.keySearch = object.title;
      this.isFocused = false;
      
      // Set specific result for selected item
      this.searchStore.setResults([object]);
      
      // Navigate to search results
      this.$router.push("/searchResult");
    },

    // Method để clear search
    clearSearch() {
      this.keySearch = "";
      this.recomendData = [];
      this.isFocused = false;
    }
  },

  async mounted() {
    document.addEventListener("click", this.handleClickOutside);
    
    // Pre-load data on component mount để cải thiện UX
    await this.loadData();
  },

  beforeUnmount() {
    document.removeEventListener("click", this.handleClickOutside);
    // Clear timeout khi component bị destroy
    if (this.searchTimeout) {
      clearTimeout(this.searchTimeout);
    }
  }
};
</script>

<style scoped>
/* Thêm style để cải thiện UX */
.relative {
  position: relative;
}

/* Style cho dropdown suggestions */
.absolute.top-full {
  border-top: 1px solid #e5e7eb;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

/* Loading state (có thể thêm sau) */
.loading {
  opacity: 0.6;
  pointer-events: none;
}
</style>