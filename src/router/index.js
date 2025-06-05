// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import productDetail from '../components/productDetail.vue'
import homePage from '../components/homePage.vue'
import cart from '../components/cart.vue'
import allProducts from '../components/allProducts.vue'
import login from '../components/login.vue'
const routes = [
  
   {
    path: '/',
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
    component :cart,
     meta: { requiresAuth: true }
  },
  {
   path: '/login',
   name: 'login',
   component: login
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
  const isLoggedIn = !!localStorage.getItem("accessToken"); // hoặc sessionStorage
  if (to.meta.requiresAuth && !isLoggedIn) {
    next({ name: 'login' });  // chuyển hướng đến trang đăng nhập
  } else {
    next(); // tiếp tục đi đến route đó
  }
});
export default router;
