import { createApp } from 'vue';

import { createRouter, createWebHashHistory } from 'vue-router';

import App from './components/App.vue';
import Login from './components/Login.vue'
import Home from './components/homepage.vue'
import Ex from './components/Example.vue'

const app = createApp(App);
const routes = [
    {
        path: '/',
        component: Login,
    },
    {
        path: '/home',
        component: Home,
    },
    {
        path: '/example',
        component: Ex,
    }
];
const router = createRouter({
  history: createWebHashHistory(),
  routes: routes,
});

app.use(router);

app.mount('#app');
