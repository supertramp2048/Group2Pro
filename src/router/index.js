// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import productDetail from '../components/productDetail.vue'
import homePage from '../components/homePage.vue'

const routes = [
  
   {
    path: '/',
    name: 'homePage',
    component: homePage,
  },
  {
    path: '/homePage',
    name: 'homePage',
    component: homePage,
    
  },
  {
    path: '/productDetail/:id',
    name: 'productDetail',
    component :productDetail,
    props: true
  }
  
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
