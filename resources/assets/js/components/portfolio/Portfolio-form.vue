<template>
	<v-container fluid>
		<!-- Form -->
		<v-form v-model="valid" ref="form" lazy-validation>
		  <image-input
		  	@image-selected="imageSelected"
		  	:clear="fields.src"
		  	class="mt-3"
		  >
		  </image-input>				  
		  <v-text-field
		  	class="mt-3"
		    label="Description"
		    v-model="fields.description"
		    :rules="rules.description"
		    :counter="40"
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
		</v-form>	
		<!-- / Form -->	
	</v-container>	
</template>

<script>
	import ImageInput from './../_assets/Image-input';
	import Helpers from './../../resources/helpers';
	
  export default {
  	props: ['image'],

  	components: {
  		'image-input': ImageInput
  	},
  	
    data: () => ({
      valid: false,
      isSaving: false,
      dispatchAction: 'createPortfolioImage',
      // Form data
      fields: {
      	id: '',
      	description: '',
      	src: ''
      },

      // Validation rules
      rules: {
	      description: [
	        (v) => v && v.length <= 50 || 'Description must be less than 50 characters'
	      ]                 	
      }  
    }),
    
    methods: {
      submit () {
        if(this.$refs.form.validate()) {
        	console.log(this.fields);
        	// Toggle loader
        	this.isSaving = true;
        	// Dispatch event to store
        	this.$store.dispatch(this.dispatchAction, this.fields)
        		.then((response) => {
        			// Toggle loader
        			this.isSaving = false;
      				// Clear form
      				Helpers.resetForm(this.fields);
      				this.clear();        			
      				// An artist was updated
      				this.$emit('saved');
        		});
        }
      },
      clear () {
        this.$refs.form.reset()
      },
      imageSelected (image) {
      	// Cache base64 image in form
      	this.fields.src = image;
      }
    },

    created () {
    	// If image is present then its an update from
    	if(this.image) {
    		// Change dispatch action
    		this.dispatchAction = 'updatePortfolioImage';
    		// Populate Form
    		Helpers.populateForm(this.fields, this.image);
    		// Show save button
    		this.valid = true;
    	}

    	this.$store.dispatch('getUserArtists');
    }

  }	
</script>