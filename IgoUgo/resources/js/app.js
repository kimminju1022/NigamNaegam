require('./bootstrap');

import { createApp } from 'vue';
import router from './router.js';
import store from './store/store';
import AppComponent from '../views/components/AppComponent.vue';

createApp({
    components: {
        AppComponent,
    }

})
.use(store)
.use(router)
.mount('#app');