// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import productDetail from '../components/productDetail.vue'
import homePage from '../components/homePage.vue'
import cart from '../components/cart.vue'
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
  },
  {
    path: '/cart',
    name: 'cart',
    component :cart
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
