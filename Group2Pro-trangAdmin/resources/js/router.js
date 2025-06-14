import { createRouter, createWebHistory } from "vue-router";

import Users from "./Components/Users/index.vue";
import Products from "./Components/Products/index.vue";
import Cart from "./Components/UserCart/index.vue"; // file vẫn tên UserCart/index.vue

const routes = [
    {
        path: "/users",
        component: Users,
    },
    {
        path: "/products",
        component: Products,
    },
    {
        path: "/cart", 
        component: Cart,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
