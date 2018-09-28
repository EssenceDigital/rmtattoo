<template>
	<v-container fluid>
		<!-- Form -->
		<v-form v-model="valid" ref="form" lazy-validation>
		  <v-text-field
		  	class="mt-2"
		    label="Question"
		    v-model="fields.question"
		    :rules="rules.question"
		    :counter="150"
		    required
		    multi-line
		  ></v-text-field>
		  <v-text-field
		  	class="mt-2"
		    label="Answer"
		    v-model="fields.answer"
		    :rules="rules.answer"
		    :counter="1750"
		    required
		    multi-line
		  ></v-text-field>
      <v-select
      	v-if="faq"
      	:items="faqsSelectList"
        v-model="fields.order"     
        label="Order..."
        single-line
        auto
        hide-details 	
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
		  <!-- Delete faq -->
		  <v-tooltip top>
			  <v-btn
			  	v-if="faq"
			  	@click="removeDialog = true"
			  	icon
			  	class="mt-5 ml-0 error--text"
			  	slot="activator"
			  >
			  	<v-icon>delete_sweep</v-icon>
			  </v-btn>		  
			  <span>Remove</span>	
		  </v-tooltip>
		  <!-- / Delete faq-->
		</v-form>	
		<!-- / Form -->	
		<!-- Remove dialog -->
		<v-layout v-if="removeDialog" row justify-center>
		  <v-dialog v-model="removeDialog" persistent>
		    <v-card>
		      <v-card-title class="subheading">Remove question?</v-card-title>
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
  	props: ['faq'],

    data: () => ({
      valid: false,
      isSaving: false,
      isRemoving: false,
      removeDialog: false,
      dispatchAction: 'createFaq',
      // Form data
      fields: {
      	id: '',
      	question: '',
      	answer: '',
      	order: ''
      },

      // Validation rules
      rules: {
	      question: [
	        (v) => !!v || 'Name is required',
	        (v) => v && v.length <= 150 || 'Name must be less than 150 characters'
	      ],
	      answer: [
	        (v) => !!v || 'Description is required',
	        (v) => v && v.length <= 1750 || 'Description must be less than 300 characters'
	      ]	            	
      }  
    }),

    computed: {
    	faqsSelectList(){
    		return this.$store.getters.faqsSelectList;
    	}
    },

    watch: {
    	faq(value){
    		// Change dispatch action
    		this.dispatchAction = 'updateFaq';    		
    		// Populate Form
    		Helpers.populateForm(this.fields, value);    		
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
	        		// Clear form        			
        			if(!this.faq) {
	        			Helpers.resetForm(this.fields);
	        			this.clear();        				
        			}
      				// A faq was updated
      				this.$emit('saved');
        		});
        }
      },
      remove () {
      	// Toggle loader
      	this.isRemoving = true;
      	// A faq was removed
      	this.$emit('saved');       	
      	// Dispatch event to store
      	this.$store.dispatch('removeFaq', this.fields.id)
      		.then(() => {     			
      			// Toggle loader
      			this.isRemoving = false;
      		});
      },
      clear () {
        this.$refs.form.reset()
      }
    },

    created () {
    	// If faq is present then its an update from
    	if(this.faq) {
    		// Change dispatch action
    		this.dispatchAction = 'updateFaq';
    		// Populate Form
    		Helpers.populateForm(this.fields, this.faq);
    		// Show save button
    		this.valid = true;

    		console.log(this.fields.order);
    	}
    }

  }
</script>