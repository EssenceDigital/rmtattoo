// Load Vue based dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';
// Load Project components needed by routes
import PortfolioView from './../components/_views/Portfolio-view';
import FaqsView from './../components/_views/Faqs-view';
import UsersView from './../components/_views/Users-view';
import BookingArtistsView from './../components/_views/Booking-artists-view';

// Register router with Vue
Vue.use(VueRouter);

export default new VueRouter({
	routes: [
		{
			path: '/booking-artists',
			name: 'BookingArtistsView',
			component: BookingArtistsView
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
			path: '/users',
			name: 'UsersView',
			component: UsersView
		}
	]
});
