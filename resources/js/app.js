import Vue from 'vue';
import axios from 'axios';

import CreatePurchase from './components/create-purchase';
/** Vue Select **/
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';


import 'primevue/resources/themes/saga-blue/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';
/** Third componnets **/

Vue.component('vSelect', vSelect);
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
Vue.use(ToastService);

/** End Vue Select **/

/** End third components **/

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Vue = Vue;

new Vue({
    el: '#app',
    components: {
        CreatePurchase,
        Toast
    }
});
