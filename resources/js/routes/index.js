import {createRouter, createWebHistory} from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginView from "../views/LoginView.vue";
import UsersView from "../views/UsersView.vue";
import AddUserView from "../views/AddUserView.vue";
import EditUserView from "../views/EditUserView.vue";
import ProductsView from "../views/ProductsView.vue";
import AddProductView from "../views/AddProductView.vue";
import EditProductView from "../views/EditProductView.vue";
import OrdersView from "../views/OrdersView.vue";
import AddOrderView from "../views/AddOrderView.vue";
import EditOrderView from "../views/EditOrderView.vue";


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView,
            meta: {
                title: 'Home',
            },
        },
        {
            path: '/login',
            name: 'login',
            component: LoginView,
            meta: {
                title: 'Login',
            },
        },
        {
            path: '/users',
            name: 'users',
            component: UsersView,
            meta: {
                title: 'Users',
            },
        },
        {
            path: '/adduser',
            name: 'adduser',
            component: AddUserView,
            meta: {
                title: 'Add User',
            },
        },
        {
            path: '/edituser',
            name: 'edituser',
            component: EditUserView,
            meta: {
                title: 'Edit User',
            },
        },
        {
            path: '/orders',
            name: 'orders',
            component: OrdersView,
            meta: {
                title: 'Orders',
            },
        },
        {
            path: '/addorder',
            name: 'addorder',
            component: AddOrderView,
            meta: {
                title: 'Add Order',
            },
        },
        {
            path: '/editorder',
            name: 'editorder',
            component: EditOrderView,
            meta: {
                title: 'Edit Order',
            },
        },
        {
            path: '/products',
            name: 'products',
            component: ProductsView,
            meta: {
                title: 'Products',
            },
        },
        {
            path: '/editproduct',
            name: 'editproduct',
            component: EditProductView,
            meta: {
                title: 'Edit Product',
            },
        },
        {
            path: '/addproduct',
            name: 'addproduct',
            component: AddProductView,
            meta: {
                title: 'Add Product',
            },
        },
    ]
})

router.beforeEach((to, from) => {
    document.title = to.meta?.title ?? 'Default Title'
})  

export default router
