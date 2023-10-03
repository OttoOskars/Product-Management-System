import { createApp } from 'vue';

import App from './components/App.vue';

const app = createApp(App);


import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { fas } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(fas, fab)
app.component('font-awesome-icon', FontAwesomeIcon)

app.mount('#app');
