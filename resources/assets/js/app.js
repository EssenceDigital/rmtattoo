require('./resources/bootstrap');

// Load Vue based dependencies
import Vue from 'vue';
import Vuetify from 'vuetify';
import { store } from './store/index';
import VueClip from 'vue-clip';
import VueSilentbox from 'vue-silentbox';
import 'vue-event-calendar/dist/style.css';
import vueEventCalendar from 'vue-event-calendar';

// Register Vue based dependencies
Vue.use(Vuetify);
Vue.use(VueClip);
Vue.use(VueSilentbox);
Vue.use(vueEventCalendar, {locale: 'en'});
/** Register Vue filters */
import DateFilter from './filters/date';
Vue.filter('date', DateFilter);

// Set up Router
import Router from './resources/router';
// Register Vue components
Vue.component('dashboard', require('./Dashboard.vue'));

const app = new Vue({
    el: '#app',
    router: Router,
    store: store
});
