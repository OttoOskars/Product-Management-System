import { createApp } from 'vue';

import Login from './components/login.vue';

const login = createApp(Login);


import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { fas } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(fas, fab)
login.component('font-awesome-icon', FontAwesomeIcon)

login.mount('#login');
