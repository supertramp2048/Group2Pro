<template>
  <div class="w-4/6 flex relative z-50">
    <form @submit.prevent="getSearchData" class="w-full">
  <div class="relative w-full">
    <input
      type="text"
      class="block w-full h-12 text-xl pl-4 pr-10 font-medium text-gray-900 bg-white rounded-2xl"
      placeholder="Tìm kiếm"
      v-model="keySearch"
    />
    <button
      type="submit"
      class="absolute right-2 top-1/2 -translate-y-1/2 text-white hover:text-gray-700 bg-red-500 rounded-2xl p-1"
    >
      search
    </button>
  </div>
</form>


    <div
      class="absolute top-full left-0 flex flex-col w-full  z-50"
    >
      <div
        v-for="object in recomendData"
        :key="object.id"
        class=" block px-4 py-2 text-xl bg-white hover:bg-gray-100 cursor-pointer border-b border-gray-200 z-50"
      >
        {{ object.title }}
      </div>
    </div>

    <searchList :searchList="recomendData"></searchList>
  </div>
</template>
<script>
import searchList from "./searchList.vue";
export default {
  data() {
    return {
      keySearch: "",
      recomendData: [],
      searchList: [],
    };
  },
  methods: {
    async loadData() {
      let res = await fetch(`http://localhost:3000/posts`);
      this.searchList = await res.json();
      console.log(this.searchList);
    },

    async getSearchData() {
      console.log(this.keySearch);

      await this.loadData();
      if (this.keySearch == " " || this.keySearch == "") {
        this.recomendData = [];
      } else {
        this.recomendData = this.searchList.filter((item) =>
          item.title?.toLowerCase().includes(this.keySearch.toLowerCase())
        );
      }

      console.log(this.recomendData);
    },
  },
  watch: {
    keySearch(newVal, oldVal) {
      this.getSearchData();
    },
  },
};
</script>