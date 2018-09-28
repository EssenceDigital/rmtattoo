<template>
	<v-container fluid>
		<!-- Form -->
		<v-form v-model="valid" ref="form" lazy-validation>
		  <v-text-field
		  	class="mt-2"
		    label="First"
		    v-model="fields.first"
		    :rules="rules.first"
		  ></v-text-field>
		  <v-text-field
		  	class="mt-2"
		    label="Last"
		    v-model="fields.last"
		    :rules="rules.last"
		  ></v-text-field>
		  <v-text-field
		  	class="mt-2"
		    label="Phone"
		    v-model="fields.phone"
		    :rules="rules.phone"
		  ></v-text-field>		  
		  <v-text-field
		  	class="mt-2"
		    label="Email"
		    v-model="fields.email"
		    :rules="rules.email"
		  ></v-text-field>
      <v-select
      	:items="artistsSelectList"
        v-model="fields.user_id"
        :rules="rules.artist"     
        label="Artist..."
        single-line
        auto
        hide-details 	
      >
      </v-select>	
		  <v-text-field
		  	class="mt-2"
		    label="Size"
		    v-model="fields.tattoo_size"
		    :rules="rules.tattoo_size"
		  ></v-text-field>      	  		  		  
		  <v-text-field
		  	class="mt-2"
		    label="Description"
		    v-model="fields.description"
		    :rules="rules.description"
		  ></v-text-field>
		  <v-text-field
		  	class="mt-2"
		    label="Location"
		    v-model="fields.location"
		    :rules="rules.location"
		  ></v-text-field>
      <v-select
      	:items="[
      		{ text: 'Black and Grey', value: 'Black-and-grey' },
      		{ text: 'Color', value: 'Color' }
      	]"
        v-model="fields.color_preference"
        :rules="rules.color_preference"     
        label="Color...."
        single-line
        auto
        hide-details 	
      >
      </v-select>	
      <v-select
      	:items="[
      		{ text: 'Traditional', value: 'Traditional' },
      		{ text: 'Realistic', value: 'Realistic' },
      		{ text: 'Water Color', value: 'Water-color' }
      	]"
        v-model="fields.tattoo_style"
        :rules="rules.tattoo_style"     
        label="Style..."
        single-line
        auto
        hide-details 	
      >
      </v-select>	  
		  <v-text-field
		  	class="mt-2"
		    label="Budget"
		    v-model="fields.budget"
		    :rules="rules.budget"
		  ></v-text-field>          	  		  

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
		  <!-- Delete booking -->
		  <v-tooltip top>
			  <v-btn
			  	v-if="booking"
			  	@click="removeDialog = true"
			  	icon
			  	class="mt-5 ml-0 error--text"
			  	slot="activator"
			  >
			  	<v-icon>delete_sweep</v-icon>
			  </v-btn>		  
			  <span>Remove</span>	
		  </v-tooltip>
		  <!-- / Delete artist -->
		</v-form>	
		<!-- / Form -->	
		<!-- Remove dialog -->
		<v-layout v-if="removeDialog" row justify-center>
		  <v-dialog v-model="removeDialog" persistent>
		    <v-card>
		      <v-card-title class="subheading">Remove booking?</v-card-title>
		      <v-card-actions>
		        <v-spacer></v-spacer>
		        <v-btn color="green darken-1" flat @click.native="removeDialog = false">Maybe Not</v-btn>
		        <v-btn 
		        	@click.native="remove"		        
					  	:disabled="isRemoving"
					  	:loading="isRemoving"		        
		        	color="red darken-1" 
		        	flat 
		        >
		        	Yes
		        </v-btn>
		      </v-card-actions>
		    </v-card>
		  </v-dialog>
		</v-layout>		
		<!-- / Remove dialog -->
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
      dispatchAction: 'createBooking',
      // Form data
      fields: {
      	id: '',
      	first: '',
      	last: '',
      	phone: '',
      	email: '',
      	user_id: '', 
      	tattoo_size: '',
      	description: '',
      	location: '',
      	color_preference: '', 
      	tattoo_style: '',
      	budget: ''
      },

      // Validation rules
      rules: {
	      first: [
	        (v) => !!v || 'First is required',
	        (v) => v && v.length <= 25 || 'First must be less than 25 characters'
	      ],
	      last: [
	        (v) => !!v || 'Last is required',
	        (v) => v && v.length <= 25 || 'Last must be less than 25 characters'
	      ],
	      phone: [
	        (v) => !!v || 'Phone is required',
	        (v) => v && v.length <= 14 || 'Phone must be less than 14 characters'
	      ],
	      email: [
	        (v) => !!v || 'Email is required',
	        (v) => v && v.length <= 50 || 'Email must be less than 50 characters'
	      ],	 
	      tattoo_size: [
	        (v) => v && v.length <= 65 || 'Size must be less than 65 characters'
	      ],	        
	      description: [
	        (v) => !!v || 'Description is required',
	        (v) => v && v.length <= 255 || 'Description must be less than 255 characters'
	      ],	
	      location: [
	        (v) => !!v || 'Location is required',
	        (v) => v && v.length <= 65 || 'Location must be less than 65 characters'
	      ],	
	      color_preference: [
	        (v) => !!v || 'Color is required',
	        (v) => v && v.length <= 25 || 'Color must be less than 25 characters'
	      ],	  
	      tattoo_style: [
	        (v) => v && v.length <= 45 || 'Style must be less than 45 characters'
	      ],
	      budget: [
	        (v) => v && v.length <= 25 || 'Budget must be less than 25 characters'
	      ]	                    
      }  
    }),

    computed: {
    	artistsSelectList () {
    		return this.$store.getters.userArtistsSelectList;
    	}
    },

    watch: {
    	booking (value) {
    		if(value) {
	    		// Change dispatch action
	    		this.dispatchAction = 'updateBooking';    
	    		// Populate form			
    			Helpers.populateForm(this.fields, value);
    		}
    	}
    },
    
    methods: {
      submit () {
        if (this.$refs.form.validate()) {
        	// Toggle loader
        	this.isSaving = true;
        	// Dispatch event to store
        	this.$store.dispatch(this.dispatchAction, this.fields)
        		.then((response) => {
        			// Toggle loader
        			this.isSaving = false;
        			// Only clear the form if a new artist was created
        			if(! this.artist){
	        			// Clear form
	        			Helpers.resetForm(this.fields);
	        			this.clear();        				
        			}
      				// A booking was saved
      				this.$emit('saved');
        		});
        }
      },
      remove () {
      	// Toggle loader
      	this.isRemoving = true;
      	// Dispatch event to store
      	this.$store.dispatch('removeBooking', this.fields.id)
      		.then(() => {
      			// Toggle loader
      			this.isRemoving = false;
      			// Toggle dialog
      			this.removeDialog = false;
    				// A booking was removed
    				this.$emit('saved')      			
      		});
      },
      clear () {
        this.$refs.form.reset()
      }
    },

    created () {
    	// If booking is present then its an update from
    	if(this.booking) {
    		// Change dispatch action
    		this.dispatchAction = 'updateBooking';
    		// Populate Form
    		Helpers.populateForm(this.fields, this.booking);
    		// Show save button
    		this.valid = true;
    	}
    }

  }
</script>

<style>

</style>