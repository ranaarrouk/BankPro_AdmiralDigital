import {createRouter, createWebHistory} from "vue-router";
import HelloWorld from '../components/HelloWorld.vue';

const routes = [
    {
        path: '/login',
        name: 'Login',
        component: HelloWorld
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

export default router;
