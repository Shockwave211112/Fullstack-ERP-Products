import { createRouter, createWebHistory } from 'vue-router';

import App from './App.vue';
import AuthView from './components/AuthView.vue'
import MainView from "@/components/MainView.vue";

const routes = [
    {
        path: '/',
        component: App,
        redirect: {
            name: 'Auth'
        },
        children: [
            {
                path: '/main',
                component: MainView,
                name: 'Base'
            },
            {
                path: 'auth',
                component: AuthView,
                name: 'Auth'
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
