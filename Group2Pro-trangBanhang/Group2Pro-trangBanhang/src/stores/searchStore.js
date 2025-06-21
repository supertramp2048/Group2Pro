// src/stores/listStore.js
import { defineStore } from 'pinia'

 const searchStore = defineStore ('search', {
  state: () => ({
    results: []
  }),
  actions: {
    setResults(data) {
        this.results = data
    }
  }
})
export default searchStore