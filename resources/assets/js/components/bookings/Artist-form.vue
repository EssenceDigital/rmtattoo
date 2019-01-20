<template>
	<v-container fluid>
		<!-- Form -->
		<v-form v-model="valid" ref="form" lazy-validation>
		  <v-text-field
		  	class="mt-2"
		    label="Name"
		    v-model="fields.name"
		    :rules="rules.name"
		    :counter="75"
		    required
		  ></v-text-field>

			<v-select
        :items="[
        	{ text: 'No', value: 0 },
        	{ text: 'Yes', value: 1 }
        ]"
        v-model="fields.active"
		    :rules="rules.active"
        label="Active"
        class="mt-3"
        single-line
        auto
        hide-details
      ></v-select>

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
		  <!-- Delete user -->
		  <v-tooltip top>
			  <v-btn
			  	v-if="artist"
			  	@click="removeDialog = true"
			  	icon
			  	class="mt-5 ml-0 error--text"
			  	slot="activator"
			  >
			  	<v-icon>delete_sweep</v-icon>
			  </v-btn>
			  <span>Remove</span>
		  </v-tooltip>
		  <!-- / Delete user -->
		</v-form>
		<!-- / Form -->

		<!-- Remove dialog -->
		<v-layout v-if="removeDialog" row justify-center>
		  <v-dialog v-model="removeDialog" persistent>
		    <v-card>
		      <v-card-title class="subheading">Remove artist?</v-card-title>
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
  	props: ['artist'],

    data: () => ({
      valid: false,
      isSaving: false,
      isRemoving: false,
      removeDialog: false,
      dispatchAction: 'createBookingArtist',
      // Form data
      fields: {
      	id: '',
        name: '',
      	active: ''
      },

      // Validation rules
      rules: {
	      name: [
	        (v) => !!v || 'Name is required',
	        (v) => v && v.length <= 75 || 'Name must be less than 75 characters'
	      ]
      }
    }),



    watch: {
    	artist (value){
				if(!value){
					this.clear();
				}
    		if(value.id){
	    		// Change dispatch action
	    		this.dispatchAction = 'updateBookingArtist';
	    		// Populate Form
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
        			// Only clear the form if a new user was created
        			if(! this.artist){
	        			// Clear form
	        			Helpers.resetForm(this.fields);
	        			this.clear();
        			}
      				// A user was updated
      				this.$emit('saved');
        		});
        }
      },
      remove () {
      	// Toggle loader
      	this.isRemoving = true;
      	// Dispatch event to store
      	this.$store.dispatch('removeBookingArtist', this.artist.id)
      		.then((response) => {
      			// Toggle loader
      			this.isRemoving = false;
      			// Toggle dialog
      			this.removeDialog = false;
    				// A user was removed
    				this.$emit('saved');
      		});
      },
      clear () {
        this.$refs.form.reset()
      }
    },

    created () {
    	// If user is present then its an update from
    	if(this.artist) {
    		// Change dispatch action
    		this.dispatchAction = 'updateArtist';
    		// Populate Form
    		Helpers.populateForm(this.fields, this.artist);
    		// Show save button
    		this.valid = true;
    	}
    }

  }
</script>

<style>

</style>
