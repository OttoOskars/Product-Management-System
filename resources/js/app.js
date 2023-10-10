import { createApp } from 'vue';

import axios from 'axios';
import { createRouter, createWebHashHistory } from 'vue-router';


import App from './components/App.vue';
import Login from './components/Login.vue'
import Home from './components/homepage.vue'
import Ex from './components/Example.vue'
import login_page from './components/login_page.vue'

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
    },
    {
        path: '/login',
        component: login_page,
    }
];
const router = createRouter({
  history: createWebHashHistory(),
  routes: routes,
});

app.config.globalProperties.$axios = axios;
app.use(router);

// Define a custom Vue warning handler
app.config.warnHandler = (warning, vm, trace) => {
    // Check if the warning message includes "ion-icons"
    if (warning.includes('ion-icons')) {
      // Ignore the warning related to ion-icons
      return;
    }
  };

app.mount('#app');
