import {createRouter, createWebHistory} from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/RegisterView.vue";
import UsersView from "../views/UsersView.vue";

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
            path: '/register',
            name: 'register',
            component: RegisterView,
            meta: {
                title: 'Register',
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
    ]
})

router.beforeEach((to, from) => {
    document.title = to.meta?.title ?? 'Default Title'
})  

export default router
