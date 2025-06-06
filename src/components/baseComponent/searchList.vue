<template>
    <span >
        <searchObject v-for="(sObject) in searchList" :key="sObject.id" :searchObject="sObject"></searchObject>
    </span>
</template>
<script>

import searchObject from './searchObject.vue'
export default {
     props:["searchList"],
    data(){
        components: {searchObject}
        return{
           
        }
    }
}
</script>