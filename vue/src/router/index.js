import {createRouter, createWebHistory} from "vue-router";
import AuthLayout from '../components/AuthLayout.vue';
import Dashboard from '../views/Dashboard.vue';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import store from "../store";

const routes = [
    {path: '/dashboard', name: 'Dashboard', component: Dashboard},
    {
        path: '/auth',
        redirect: '/Login',
        component: AuthLayout,
        meta: {isGest: true},
        children: [
            {
                path: '/login',
                name: 'Login',
                component: Login
            },
            {
                path: '/register',
                name: 'Register',
                component: Register
            }
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({name: 'Login'})
    } else if (store.state.user.token && to.meta.isGest) {
        next({name: 'Dashboard'})
    } else {
        next();
    }
});

export default router;
