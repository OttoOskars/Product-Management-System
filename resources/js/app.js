import { createApp } from 'vue';
import store from '/resources/js/store.js';
import axios from 'axios';
axios.defaults.baseURL = 'http://127.0.0.1:8000';

import App from './components/App.vue';
import router from './router.js';

const app = createApp(App);
app.use(store);
app.config.globalProperties.$axios = axios;

app.config.warnHandler = (warning, vm, trace) => {
    if (warning.includes('ion-icons')) {
        return;
    }
};

app.use(router);
app.mount('#app');
