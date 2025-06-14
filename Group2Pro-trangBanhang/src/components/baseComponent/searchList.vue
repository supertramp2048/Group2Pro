<template>
  <div v-show="isFocused">
    <searchObject
      v-for="(sObject) in searchList"
      :key="sObject.id"
      :searchObject="sObject"
    />
  </div>
</template>

<script>
import searchObject from './searchObject.vue'

export default {
  components: {
    searchObject
  },
  props: ['searchList', 'isFocused'],
  data() {
    return {
      // Có thể khai báo thêm nếu cần
    }
  }
}
</script>
