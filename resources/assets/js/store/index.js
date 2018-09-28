import Vue from 'vue';
import Vuex from 'vuex';
import ApiHelper from './../resources/api';
import Helpers from './../resources/helpers';

Vue.use(Vuex);

/** 
 * Holds state that can be used accross all components
*/
export const store = new Vuex.Store({
	/** 
	 * The cache values to be centralized 
	*/
	state: {
		portfolioImages: [],
		faqs: [],
		bookings: [],
		users: [],
		userArtists: []
	},

	/**
	 * Methods that directly change the state cache.
	 *
	 * Method names are self descriptive so comments are only added where clarity is needed.
	*/
	mutations: {

		updatePortfolioImages (state, payload) {
			return state.portfolioImages = payload;
		},
		addPortfolioImage (state, payload) {
			return state.portfolioImages.push(payload);
		},
		updatePortfolioImage (state, payload) {
			// Get index of updated payload
			let index = Helpers.pluckObjectById(state.portfolioImages, 'id', payload.id);
			// Have to remove to trigger computed prop in components
			state.portfolioImages.splice(index, 1);
			// Re-add updated payload at same index
			return state.portfolioImages.splice(index, 0, payload);
		},
		removePortfolioImage (state, payload) {
			// Get index of item to remove
			let index = Helpers.pluckObjectById(state.portfolioImages, 'id', payload);
			// Remove
			return state.portfolioImages.splice(index, 1);
		},

		updateFaqs (state, payload) {
			return state.faqs = payload;
		},
		addFaq (state, payload) {
			return state.faqs.push(payload);
		},
		updateFaq (state, payload) {
			// Get index of updated payload
			let firstIndex = Helpers.pluckObjectById(state.faqs, 'id', payload.first.id);
			// Have to remove to trigger computed prop in components
			state.faqs.splice(firstIndex, 1);

			if(payload.second){
				let secondIndex = Helpers.pluckObjectById(state.faqs, 'id', payload.second.id);
				// Have to remove to trigger computed prop in components
				state.faqs.splice(secondIndex, 1);	
				// Add updated second faq
				state.faqs.splice(firstIndex, 0, payload.second);			
			}

			// Re-add updated payload at same index
			state.faqs.splice(firstIndex, 0, payload.first);

			state.faqs.sort(function (a, b) {
			  return a.order - b.order;
			});

			return;
		},
		removeFaq (state, payload) {
			// Get index of item to remove
			let index = Helpers.pluckObjectById(state.faqs, 'id', payload);
			// Remove
			return state.faqs.splice(index, 1);
		},


		updateBookings (state, payload) {
			state.bookings = payload;
		},
		addBooking (state, payload) {
			return state.bookings.push(payload);
		},		
		updateBooking (state, payload) {
			// Get index of updated payload
			let index = Helpers.pluckObjectById(state.bookings, 'id', payload.id),
					oldBooking = state.bookings[index];
			// Have to remove to trigger computed prop in components
			state.bookings.splice(index, 1);

			return state.bookings.splice(index, 0, payload);				
		},
		removeBooking (state, payload) {
			// Get index of item to remove
			let index = Helpers.pluckObjectById(state.bookings, 'id', payload);
			// Remove
			return state.bookings.splice(index, 1);
		},

		updateUsers (state, payload) {
			return state.users = payload;
		},
		updateUserArtists (state, payload) {
			return state.userArtists = payload;
		},		
		addUser (state, payload) {
			return state.users.push(payload);
		},
		updateUser (state, payload) {
			// Get index of updated payload
			let index = Helpers.pluckObjectById(state.users, 'id', payload.id);
			// Have to remove to trigger computed prop in components
			state.users.splice(index, 1);
			// Re-add updated payload at same index
			return state.users.splice(index, 0, payload);
		},
		removeUser (state, payload) {
			// Get index of item to remove
			let index = Helpers.pluckObjectById(state.users, 'id', payload);
			// Remove
			return state.users.splice(index, 1);
		},		
	},

	/** 
	 * Actions that send API server calls and manipulate the database.
	 *
	 * Method names are self descriptive so comments are only added where clarity is needed.
	*/
	actions: {
		getPortfolioImages (context, payload) {
			return ApiHelper.getAction(context, '/portfolio-images', 'updatePortfolioImages');
		},		
		createPortfolioImage (context, payload) {
			return ApiHelper.postAction(context, payload, '/portfolio-images/create', 'addPortfolioImage');			
		},
		updatePortfolioImage (context, payload) {
			return ApiHelper.postAction(context, payload, '/portfolio-images/update', 'updatePortfolioImage');	
		},
		removePortfolioImage (context, payload) {
			return ApiHelper.removeAction(context, '/portfolio-images/remove/' + payload, 'removePortfolioImage');
		},

		getFaqs (context, payload) {
			return ApiHelper.getAction(context, '/faqs', 'updateFaqs');
		},		
		createFaq (context, payload) {
			return ApiHelper.postAction(context, payload, '/faqs/create', 'addFaq');			
		},
		updateFaq (context, payload) {
			return ApiHelper.postAction(context, payload, '/faqs/update', 'updateFaq');	
		},
		removeFaq (context, payload) {
			return ApiHelper.removeAction(context, '/faqs/remove/' + payload, 'removeFaq');
		},

		getBookings (context, payload) {
			var url = '/bookings'
			// Create payload 
			if(payload){
				// Add booking status to string or a false bool
				if(payload.status != '') url += '/' + payload.status;
					else url += '/' + 0;
				// Add artist to string or a false bool
				if(payload.artist != '') url += '/' + payload.artist;
					else url += '/' + 0;					
				// Add from date to string or a false bool
				if(payload.from_date != null) url += '/' + payload.from_date;
					else url += '/' + 0;
				// Add to date to string or a false bool
				if(payload.to_date != null) url += '/' + payload.to_date;
					else url += '/' + 0;					
			}
			// Use api to send the request
			return ApiHelper.getAction(context, url, 'updateBookings');
		},
		createBooking (context, payload) {
			return ApiHelper.postAction(context, payload, '/bookings/create', 'addBooking');			
		},
		updateBooking (context, payload) {
			return ApiHelper.postAction(context, payload, '/bookings/update', 'updateBooking');	
		},				
		saveBookingDate (context, payload, mutation) {
			return ApiHelper.postAction(context, payload, '/bookings/add-date', 'removeBooking');
		},
		updateBookingDate (context, payload, mutation) {
			return ApiHelper.postAction(context, payload, '/bookings/add-date', 'updateBooking');
		},		
		removeBooking (context, payload) {
			return ApiHelper.removeAction(context, '/bookings/remove/' + payload, 'removeBooking');
		},


		getUsers (context, payload) {
			return ApiHelper.getAction(context, '/users', 'updateUsers');
		},	
		getUserArtists (context, payload) {
			return ApiHelper.getAction(context, '/users/artists', 'updateUserArtists');
		},					
		createUser (context, payload) {
			return ApiHelper.postAction(context, payload, '/users/create', 'addUser');			
		},
		updateUser (context, payload) {
			return ApiHelper.postAction(context, payload, '/users/update', 'updateUser');	
		},
		changeUserPassword (context, payload) {
			return ApiHelper.postAction(context, payload, '/users/change-password', 'updateUser');	
		},
		removeUser (context, payload) {
			return ApiHelper.removeAction(context, '/users/remove/' + payload, 'removeUser');
		},		
	},

	/** 
	 * Getters that access the state directly (For components)
	 *
	 * Method names are self descriptive so comments are only added where clarity is needed.	 
	*/
	getters: {
		// Return the artists formatted for a vuetify select list
		artistsSelectList (state) {
			var users = state.userArtists,
          select = [{ text: "Artist...", value: "*" }];
      // Create select array
      users.forEach(function(user){
        select.push({ text: user.name, value: user.id });      		
      });		
      return select;	
		},		
		portfolioImages (state) {
			return state.portfolioImages;
		},
		faqs (state) {
			return state.faqs;
		},
		faqsSelectList (state) {
			var faqs = state.faqs,
          select = [{ text: "Order...", value: "*" }];
      // Create select array
      for(let i = 1; i <= faqs.length; i++){
        select.push({ text: i, value: i });
      }	
      return select;	
		},		
		bookings (state) {
			return state.bookings;
		},
		users (state) {
			return state.users;
		}
	}

});