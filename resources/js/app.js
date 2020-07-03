import Vue from 'vue';
import axios from 'axios';

import CreatePurchase from '../components/create-purchase';
/** Vue Select **/
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

/** Third componnets **/

Vue.component('vSelect', vSelect);
/** End Vue Select **/

/** End third components **/

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Vue = Vue;

new Vue({
    el: '#app',
    components: {
        CreatePurchase
    }
});
