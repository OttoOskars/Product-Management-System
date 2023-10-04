import { createApp } from 'vue';

import Home from './components/homepage.vue';

const home = createApp(Home);


import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { fas } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(fas, fab)
home.component('font-awesome-icon', FontAwesomeIcon)
home.mount('#home');
a