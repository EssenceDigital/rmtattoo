require('./resources/bootstrap');

// Load Vue based dependencies
import Vue from 'vue';
import Vuetify from 'vuetify';
import BookingsWidget from './components/bookings/Bookings-widget';

// Register Vue based dependencies
Vue.use(Vuetify);

Vue.component('bookings-widget', BookingsWidget);

const app = new Vue({
    el: '#bookings-form'
});
