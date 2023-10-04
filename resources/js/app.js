import { createApp } from 'vue';

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { fas } from '@fortawesome/free-solid-svg-icons'
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

/* add icons to the library */
library.add(fas, fab)
app.component('font-awesome-icon', FontAwesomeIcon)

app.use(router);

app.mount('#app');
