// Load Vue based dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';
// Load Project components needed by routes
import PortfolioView from './../components/_views/Portfolio-view';
import FaqsView from './../components/_views/Faqs-view';
import BookingsView from './../components/_views/Bookings-view';
import UsersBookingsView from './../components/_views/Users-bookings-view';
import UsersView from './../components/_views/Users-view';

// Register router with Vue
Vue.use(VueRouter);

export default new VueRouter({
	routes: [
		{
			path: '/your-bookings',
			name: 'UsersBookingsView',
			component: UsersBookingsView
		},	
		{
			path: '/portfolio',
			name: 'PortfolioView',
			component: PortfolioView
		},
		{
			path: '/faqs',
			name: 'FaqsView',
			component: FaqsView
		},
		{
			path: '/bookings',
			name: 'BookingsView',
			component: BookingsView
		},
		{
			path: '/users',
			name: 'UsersView',
			component: UsersView
		}		
	]
});
