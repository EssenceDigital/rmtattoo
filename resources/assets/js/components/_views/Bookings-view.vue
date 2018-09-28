<template>
	<div>
		<!-- Top toolbar -->
		<v-toolbar card dark prominent>
      <v-toolbar-title class="headline primary--text mr-5">
      	Bookings
      </v-toolbar-title>
      <v-btn 
				@click="addBookingDialog = true"       	
      	flat
      >
        <v-icon left>
        	add
        </v-icon>
        Booking
      </v-btn>    
    </v-toolbar>
    <!-- / Top toolbar -->
    <v-divider></v-divider>
    <!--  panel container -->
		<v-container fluid class="mt-4 pb-5">
			<v-layout row>
				<v-flex xs12>
					<bookings-table :bookingAdded="bookingAdded"></bookings-table>
				</v-flex>
			</v-layout>
		</v-container>   
		<!-- / Faq expansion panel container -->
		<!-- Add booking dialog -->
	  <v-layout row justify-center>
	    <v-dialog v-model="addBookingDialog" persistent max-width="750px">
	      <v-card>
	        <v-card-title>
	          <span class="subheading">Add booking</span>
	          <v-spacer></v-spacer>
	          <v-btn 
	          	@click="addBookingDialog = false"
	          	icon
	          >
	          	<v-icon>close</v-icon>
	          </v-btn>
	        </v-card-title>
	        <v-card-text>
	        	<booking-form @saved="addBookingDialog = false"></booking-form>
	        </v-card-text>
	      </v-card>
	    </v-dialog>
	  </v-layout>
	  <!-- /Add faq dialog --> 	 	
	</div>

</template>

<script>
	import BookingsTable from './../bookings/Bookings-table';
	import BookingForm from './../bookings/Booking-form';

	export default {
		components: {
			'bookings-table': BookingsTable,
			'booking-form': BookingForm
		},

		computed: {

		},

		data: () => ({
			addBookingDialog: false,
			bookingAdded: false,
			calendarView: false
		}),

		methods: {
			bookingSaved () {
				// Toggle value
				this.addBookingDialog = false;
				this.bookingAdded = true;
			}
		},

		created () {
			//this.$store.dispatch('getFaqs');
		}
	}
</script>