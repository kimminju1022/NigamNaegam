require('./bootstrap');

import { createApp } from 'vue';
import router from './router.js';
import store from './store/store';
import AppComponent from '../views/components/AppComponent.vue';
import AdminAppComponent from '../views/adminComponents/AppComponent.vue';

createApp({
    components: {
        AppComponent,
        AdminAppComponent,
    }

})
.use(store)
.use(router)
.mount('#app');