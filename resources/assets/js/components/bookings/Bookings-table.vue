<template>
  <v-card v-if="bookings">
	  <v-card-title>
	    <v-layout row>
				<v-flex xs3 class="pl-2 pr-2">
		      <v-select
		      	:items="[
		      		{ text: 'Requested Bookings', value: 'requested' },
		      		{ text: 'Confirmed Bookings', value: 'confirmed' },
		      	]"
		        v-model="statusFilter"      
		        label="Booking Status..."
		        single-line
		        auto
		        hide-details 	
		      >
		      </v-select>					
				</v-flex>
				<v-flex xs3 class="pl-2 pr-2">
		      <v-select
		      	:items="artistsSelectList"
		        v-model="artistFilter"      
		        label="Artist..."
		        single-line
		        auto
		        hide-details 	
		      >
		      </v-select>				
				</v-flex>
				<v-flex xs2 class="pl-2 pr-2">
		      <v-menu
		        lazy
		        :close-on-content-click="false"
		        v-model="fromDateMenu"
		        transition="scale-transition"
		        offset-y
		        full-width
		        :nudge-right="40"
		        max-width="290px"
		        min-width="290px" 
		        :disabled="statusFilter != 'confirmed'"
		      >
		        <v-text-field
		          slot="activator"
		          label="From..."
		          v-model="fromDateFilter"
		          prepend-icon="event"
		          readonly
		          :disabled="statusFilter != 'confirmed'"
		        ></v-text-field>
		        <v-date-picker v-model="fromDateFilter" no-title scrollable autosave></v-date-picker>
		      </v-menu>				
				</v-flex>  
				<v-flex xs2 class="pl-2 pr-2">
		      <v-menu
		        lazy
		        :close-on-content-click="false"
		        v-model="toDateMenu"
		        transition="scale-transition"
		        offset-y
		        full-width
		        :nudge-right="40"
		        max-width="290px"
		        min-width="290px"
		        :disabled="statusFilter != 'confirmed'"
		      >
		        <v-text-field
		          slot="activator"
		          label="To..."
		          v-model="toDateFilter"
		          prepend-icon="event"
		          readonly
		          :disabled="statusFilter != 'confirmed'"
		        ></v-text-field>
		        <v-date-picker v-model="toDateFilter" no-title scrollable autosave></v-date-picker>
		      </v-menu>				
				</v-flex>	
				<v-flex xs2 class="pl-2 pr-2">
					<v-btn 
						@click="filter"
						:loading="isFiltering"
						:disabled="isFiltering"
						block
						class="mt-3 primary" 
					>
						<v-icon left>find_replace</v-icon> Filter
					</v-btn>
				</v-flex>		    	
	    </v-layout>	  	
	  </v-card-title>

    <v-divider class="mt-3 mb-3"></v-divider>
    <v-layout row>
    	<v-flex xs6
    		<v-spacer></v-spacer>
	      <v-text-field
	        append-icon="search"
	        label="Search"
	        single-line
	        hide-details
	        v-model="search"
	      ></v-text-field>      		
    	</v-flex>
    </v-layout>    
    <v-data-table
    		:headers="headers"
        :items="bookings"
        :search="search"
        :loading="isFiltering"
        class="mt-4"
      >
      <template slot="items" slot-scope="props">
      	<tr @click="props.expanded = !props.expanded" :active="props.expanded">
	        <td class="text-xs-left" v-if="!props.item.date_booked">{{ new Date(Date.parse(props.item.created_at)).toDateString() }}</td>
	        <td class="text-xs-left" v-if="props.item.date_booked">{{ props.item.date | date }}</td>
	        <td class="text-xs-left" v-if="props.item.date_booked">{{ props.item.time }}</td>
	        <td v-if="props.item.user" class="text-xs-left">
	        	{{ props.item.user.name }}
	        </td>
	        <td v-else>
	        	<em>No preference</em>
	        </td>
	        <td class="text-xs-left">{{ props.item.first }}</td>
	        <td class="text-xs-left">{{ props.item.last }}</td>
	        <td class="text-xs-left">{{ props.item.phone }}</td>
	        <td class="text-xs-left">{{ props.item.email }}</td> 
	        <td class="text-xs-right">
						<v-menu  bottom left>
	            <v-btn icon slot="activator">
	              <v-icon>more_vert</v-icon>
	            </v-btn>						
	            <v-list>
	              <v-list-tile @click="showBookDateDialog(props.item)">
	                <v-list-tile-title>Book</v-list-tile-title>
	              </v-list-tile>  
	              <v-list-tile @click="showEditBookingDialog(props.item)">
	                <v-list-tile-title>Edit</v-list-tile-title>
	              </v-list-tile>	                          	              
	            </v-list>
         		</v-menu>		        	
	        </td>     	 	
      	</tr>
      </template>
			<template slot="expand" slot-scope="props">
	      <v-card flat>
	        <v-card-text>
	        	<v-layout row>
	        		<!-- Tattoo info col -->
	        		<v-flex xs4 class="mr-1 border-right">
	        			<v-layout row class="mb-3">
	        				<strong><h6>ABOUT THE TATTOO</h6></strong>
	        			</v-layout>	        		
			        	<v-layout row>
			        		<v-flex xs12>
				        		<p class="mb-1 primary--text"><strong><em>SIZE:</em></strong></p> 
				        		<p>
				        			{{ props.item.tattoo_size }}
				        		</p>	        			
			        		</v-flex>
			        	</v-layout>
			        	<v-layout row>
			        		<v-flex xs12>
				        		<p class="mb-1 primary--text"><strong><em>DESCRIPTION:</em></strong></p> 
				        		<p>
				        			{{ props.item.description }}
				        		</p>	        			
			        		</v-flex>
			        	</v-layout>	  
			        	<v-layout row>
			        		<v-flex xs12>
				        		<p class="mb-1 primary--text"><strong><em>LOCATION:</em></strong></p> 
				        		<p>
				        			{{ props.item.location }}
				        		</p>	        			
			        		</v-flex>
			        	</v-layout>	 
			        	<v-layout row>
			        		<v-flex xs12>
				        		<p class="mb-1 primary--text"><strong><em>COLOR PREFERENCE:</em></strong></p> 
				        		<p>
				        			{{ props.item.color_preference }}
				        		</p>	        			
			        		</v-flex>
			        	</v-layout>
			        	<v-layout row>
			        		<v-flex xs12>
				        		<p class="mb-1 primary--text"><strong><em>STYLE</em></strong></p> 
				        		<p>
				        			{{ props.item.tattoo_style }}
				        		</p>	        			
			        		</v-flex>
			        	</v-layout>
			        	<v-layout row>
			        		<v-flex xs12>
				        		<p class="mb-1 primary--text"><strong><em>BUDGET:</em></strong></p> 
				        		<p>
				        			{{ props.item.budget }}
				        		</p>	        			
			        		</v-flex>
			        	</v-layout>	        			
	        		</v-flex>
	        		<!-- / Tattoo info col -->

	        		<!-- Tattoo reference images -->
	        		<v-flex xs8>
	        			<v-layout row class="mb-3">
	        				<strong class="ml-2"><h6>REFERENCE IMAGES</h6></strong>
	        			</v-layout>	        		
		        		<v-layout v-if="props.item.images.length > 0" row>
		        			<v-flex xs4	v-for="image in props.item.images" :key="image.id" class="pl-2 pr-2">
									  <v-card 
									  	flat tile 
									  	class="mt-3"
									  >
									  	<silentbox-single :src="'storage/' + image.src" description="">
									      <v-card-media
									        :src="'storage/' + image.src"
									        height="110px"
									      >
									      </v-card-media>	                  		
									  	</silentbox-single>	
									  </v-card>		        				
		        			</v-flex>
		        		</v-layout>
		        		<v-layout v-else row class="pl-3">
		        			<p>No images were provided.</p>
		        		</v-layout>
	        		</v-flex>
	        		<!-- / Tattoo reference images -->	        		
	        	</v-layout>    		        	       	      	
	        </v-card-text>
	      </v-card>
   	 	</template>      
      <template slot="pageText" slot-scope="{ pageStart, pageStop }">
        From {{ pageStart }} to {{ pageStop }}
      </template>
    </v-data-table>

    <!-- Book date dialog -->
    <v-layout row justify-center>
      <v-dialog v-model="bookDateDialog" persistent max-width="500px">
        <v-card>
          <v-card-title>
            <span class="subheading">Save date</span>
            <v-spacer></v-spacer>
            <v-btn 
              @click="bookDateDialog = false"
              icon
            >
              <v-icon>close</v-icon>
            </v-btn>
          </v-card-title>
          <v-card-text>
            <book-date-form 
            	:booking="currentBooking" 
            	@saved="bookDateDialog = false"
            ></book-date-form>
          </v-card-text>
        </v-card>
      </v-dialog>
    </v-layout>
    <!-- /Book date dialog -->    

    <!-- Edit booking dialog -->
    <v-layout row justify-center>
      <v-dialog v-model="editBookingDialog" persistent max-width="500px">
        <v-card>
          <v-card-title>
            <span class="subheading">Edit booking</span>
            <v-spacer></v-spacer>
            <v-btn 
              @click="hideEditBookingDialog"
              icon
            >
              <v-icon>close</v-icon>
            </v-btn>
          </v-card-title>
          <v-card-text>
          	<booking-form :booking="currentBooking" @saved="bookingSaved"></booking-form>
          </v-card-text>
        </v-card>
      </v-dialog>
    </v-layout>
    <!-- / Edit booking dialog -->

  </v-card>	
</template>

<script>
	import BookDateForm from './Book-date-form';
	import BookingForm from './Booking-form';

	export default {
		props: ['bookingAdded', 'calendarView'],

		data: () => ({
			search: '',
			statusFilter: 'requested',
			artistFilter: '',
			fromDateFilter: null,
			fromDateMenu: false,			
			toDateFilter: null,
			toDateMenu: false,
			isFiltering: false,
			editBookingDialog: false,
			currentBooking: null,
			bookDateDialog: false,
			bookDateMenu: false,
			booking_id: '',
			date_booked: '',
			headers: [],
			requestedHeaders: [
				{ text: 'Date Sumbitted', value: '', align: 'left', class: "primary--text", sortable: false },
				{ text: 'Prefered Artist', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'First', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'Last', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'Phone', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'Email', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'Actions', value: '', align: 'right', class: "primary--text", sortable: false  }
			],
			confirmedHeaders: [
				{ text: 'Date', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'Time', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'Artist', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'First', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'Last', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'Phone', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'Email', value: '', align: 'left', class: "primary--text", sortable: false  },
				{ text: 'Actions', value: '', align: 'right', class: "primary--text", sortable: false  }			
			]
		}),

		components: {
			'book-date-form': BookDateForm,
			'booking-form': BookingForm
		},

		computed: {
			bookings () {
				return this.$store.getters.bookings;
			},
			artistsSelectList () {
				return this.$store.getters.artistsSelectList;
			}
		},

		watch: {
			bookingAdded (value) {
				if(value){
					this.statusFilter = 'confirmed';
					this.filter();
				}
			},

			statusFilter (value) {
				if(value === 'requested'){
					this.toDateFilter = null;
					this.fromDateFilter = null;
				}
			}
		},

		methods: {
			showBookDateDialog (booking) {
				// Set the booking id
				this.currentBooking = booking;
				// Toggle dialog
				this.bookDateDialog = true;
			},

			hideBookDateDialog () {
				// Reset current booking
				this.currentBooking = null;
				// Toggle dialog
				this.bookDateDialog = false;
			},

			showEditBookingDialog (booking) {
				// Reset current booking
				this.currentBooking = booking;				
				// Toggle dialog
				this.editBookingDialog = true;
			},

			hideEditBookingDialog () {
				// Reset current booking
				this.currentBooking = null;
				// Toggle dialog
				this.editBookingDialog = false;
			},

			bookingSaved () {
				this.editBookingDialog = false;
				this.currentBooking = null;
			},

			filter () {
				// Toggle loader
				this.isFiltering = true;

				/* Ensure filter from date is before to date
				*/ 
				if(this.fromDateFilter && this.toDateFilter){
					var itemFrom = new Date(this.fromDateFilter),
							itemTo = new Date(this.toDateFilter);
					// Compare dates and return false if to date is before from date
					if(itemTo.getTime() < itemFrom.getTime()){
						// Toggle loader 
						this.isFiltering = false;					
						// Emit even to show snackbar alert						
						this.$router.app.$emit('show-snackbar', {
							text: "From date must be before To Date."
						});					
						// Return false
						return false;
					}							
				}
				// Dispatch event to store
				this.$store.dispatch('getBookings', {
					status: this.statusFilter,
					artist: this.artistFilter,
					to_date: this.toDateFilter,
					from_date: this.fromDateFilter
				})
					.then(() => {
						if(this.statusFilter === 'confirmed') this.headers = this.confirmedHeaders;
							else if(this.statusFilter === 'requested') this.headers = this.requestedHeaders;
						// Toggle loader
						this.isFiltering = false;
					});
			}
		},

		created () {
			// Setup initial headers
			this.headers = this.requestedHeaders;
			// Dispatch event to retrieve bookings
			this.$store.dispatch('getBookings');
			// Dispatch event to retreive artists
			this.$store.dispatch('getUserArtists');
		}
	}
</script>

<style>
	.border-right{
		border-right: 1px solid #aaa;
	}
</style>