import {createRouter, createWebHistory} from "vue-router";
import AuthLayout from '../components/AuthLayout.vue';
import Dashboard from '../views/Dashboard.vue';
import Transactions from '../views/Transactions.vue';
import Deposit from '../views/Deposit.vue';
import Transfer from '../views/Transfer.vue';
import DefaultLayout from '../components/DefaultLayout.vue';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import store from "../store";

const routes = [
    {
        path: '/',
        name: 'Dashboard',
        component: DefaultLayout,
        children: [
            {
                path: '/dashboard',
                name: 'Dashboard',
                component: Dashboard
            },
            {
                path: '/transactions',
                name: 'Transactions',
                component: Transactions
            },
            {
                path: '/deposit',
                name: 'Deposit',
                component: Deposit
            },
            {
                path: '/transfer',
                name: 'Transfer',
                component: Transfer
            }
        ]},
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
