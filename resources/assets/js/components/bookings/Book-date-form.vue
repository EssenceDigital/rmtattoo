<template>
	<v-container fluid v-if="booking">
		<!-- Form -->
		<v-form v-model="valid" ref="form" :value="valid">
      <v-menu
        lazy
        :close-on-content-click="false"
        v-model="dateMenu"
        transition="scale-transition"
        offset-y
        full-width
        :nudge-right="40"
        max-width="290px"
        min-width="290px"
      >
        <v-text-field
          slot="activator"
          label="Date..."
          v-model="fields.date"
          :rules="rules.date"
          prepend-icon="event"
          readonly
        ></v-text-field>
        <v-date-picker v-model="fields.date" no-title scrollable autosave></v-date-picker>
      </v-menu>

 			<v-menu
        lazy
        :close-on-content-click="false"
        v-model="timeMenu"
        transition="scale-transition"
        offset-y
        full-width
        :nudge-right="40"
        max-width="290px"
        min-width="290px"
      >
        <v-text-field
          slot="activator"
          label="Time..."
          v-model="fields.time"
          :rules="rules.time"
          prepend-icon="access_time"
          readonly
        ></v-text-field>
        <v-time-picker v-model="fields.time" autosave></v-time-picker>
      </v-menu>

	      <v-select
	      	:items="artistsSelectList"
	        v-model="fields.artist"
	        :rules="rules.artist"     
	        label="Artist..."
	        single-line
	        auto
	        hide-details 
	        prepend-icon="person_outline"	
	      >
	      </v-select>
		  <!-- Submit form -->
		  <v-btn
		    @click="submit"
		    :disabled="!valid"
		    :loading="isSaving"
		    block
		    class="mt-4"
		  >
		    Save
		  </v-btn>
		  <!-- / Submit form -->
		</v-form>	
		<!-- / Form -->	
	</v-container>
</template>

<script>
	import Helpers from './../../resources/helpers';
	
  export default {
  	props: ['booking'],
  	
    data: () => ({
      valid: false,
      isSaving: false,
      isRemoving: false,
      removeDialog: false,
      dispatchAction: 'saveBookingDate',
      // Form data
      fields: {
      	date: null,
      	time: null,
      	artist: ''
      },
      rules: {
	      date: [
	        (v) => !!v || 'Name is required'
	      ],
	      time: [
	        (v) => !!v || 'Time is required'
	      ],
	      artist: [
	        (v) => !!v || 'Artist is required'
	      ]	            	
      },      
 			dateMenu: false,
 			timeMenu: false
    }),

		computed: {
			artistsSelectList () {
				return this.$store.getters.artistsSelectList;
			}
		},

    watch: {
      booking (value) {
        if(value) {
     
          // Cache fields     
          if(value.date) {
            this.fields.date = value.date; 
            // Update the action
            this.dispatchAction = 'updateBookingDate';            
          }         
          if(value.time) this.fields.time = value.time;
          if(value.user) this.fields.artist = value.user.id;    
        }
      }
    },

    methods: {
      submit () {
        if (this.$refs.form.validate()) {
          console.log(this.dispatchAction);
        	// Get the date time string for db
        	let dateTime = Helpers.constructDateTimeString(this.fields.date, this.fields.time);
        	// Toggle loader
        	this.isSaving = true;
        	// Dispatch event to store
        	this.$store.dispatch(this.dispatchAction, {
        		booking_id: this.booking.id,
        		date_booked: dateTime,
        		date: this.fields.date,
        		time: this.fields.time,
        		artist: this.fields.artist
        	})
        		.then((response) => {
        			// Toggle loader
        			this.isSaving = false;
        			// Only clear the form if the booking date is not present
        			if(! this.booking){
	        			// Clear form
	        			Helpers.resetForm(this.fields);
	        			this.clear();        				
        			}
      				// A booking was saved
      				this.$emit('saved');
        		});;
        }
      },
      clear () {
        this.$refs.form.reset()
      }
    },

    created () {
    	// If booking is present then cache some fields from it
    	if(this.booking) {
        // Cache fields
        if(this.booking.date) {
          // Update the action
          this.dispatchAction = 'updateBookingDate';          
          this.fields.date = this.booking.date;
        }         
        if(this.booking.time) this.fields.time = this.booking.time;
        if(this.booking.user) this.fields.artist = this.booking.user.id;       
    	}

    }

  }
</script>

<style>

</style>