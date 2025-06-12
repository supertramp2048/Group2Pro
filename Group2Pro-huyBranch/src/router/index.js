// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import productDetail from '../components/productDetail.vue'
import homePage from '../components/homePage.vue'
import cart from '../components/cart.vue'
import allProducts from '../components/allProducts.vue'
import login from '../components/login.vue'
import searchResult from '../components/searchResult.vue'
const routes = [
  
   {
    path: '/',
    name: 'homePage',
    component: homePage,
  },
  {
    path: '/searchResult',
    name: 'searchResult',
    component: searchResult,
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
    component :cart,
     meta: { requiresAuth: true }
  },
  {
    path: '/allProducts/:categoryId',
    name: 'allProducts',
    component :allProducts,
    props: true
  },

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});
router.beforeEach((to, from, next) => {
  const tokenInLocal = localStorage.getItem("accessToken");
  //const tokenInSession = sessionStorage.getItem("accessToken");
  const isLoggedIn = !!tokenInLocal; // || !!tokenInSession;

  if (to.meta.requiresAuth && !isLoggedIn) {
     window.location.href = 'http://localhost:3000/php/login.php';
     return; // dừng lại không cho đi tiếp
  } 
  next(); // tiếp tục đi đến route
});

export default router;
