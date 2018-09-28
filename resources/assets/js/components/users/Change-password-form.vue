<template>
	<v-container fluid v-if="user">
		<!-- Form -->
		<v-form v-model="valid" ref="form" lazy-validation>  
			<div v-if="requireCurrentPassword">
			  <v-text-field
			  	class="mt-2"
			    label="Current Password"
			    v-model="fields.current_password"
			    :rules="rules.current_password"
			    :counter="30"
			    required
			    type="password"
			  ></v-text-field>				
			</div>
		  <v-text-field
		  	class="mt-2"
		    label="Password"
		    v-model="fields.password"
		    :rules="rules.password"
		    :counter="30"
		    required
		    type="password"
		  ></v-text-field>
		  <v-text-field
		  	class="mt-2"
		    label="Confirm Password"
		    v-model="fields.password_confirmation"
		    :rules="rules.password_confirmation"
		    :counter="30"
		    required
		    type="password"
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
	import Helpers from './../../resources/helpers';
	
  export default {
  	props: ['user', 'requireCurrentPassword'],
  	
    data: () => ({
      valid: false,
      isSaving: false,
      isRemoving: false,
      // Form data
      fields: {
      	id: '',
      	current_password: '',
      	password: '',
      	password_confirmation: ''
      },

      // Validation rules
      rules: {
	      current_password: [
	        (v) => !!v || 'Current password is required',
	        (v) => v && v.length <= 30 || 'Password must be less than 30 characters'
	      ],
	      password: [
	        (v) => !!v || 'Password is required',
	        (v) => v && v.length <= 30 || 'Password must be less than 30 characters'
	      ],
	      password_confirmation: [
	        (v) => !!v || 'Password confirmation is required',
	        (v) => v && v.length <= 30 || 'Password confirmation must be less than 30 characters'
	      ]	                  	
      }  
    }),
    
    watch: {
    	user (value){
    		if(value.id){
					this.fields.id = value.id   
    		}
    	}
    },
    
    methods: {
      submit () {
        if (this.$refs.form.validate()) {
        	// Toggle loader
        	this.isSaving = true;
        	// Dispatch event to store
        	this.$store.dispatch('changeUserPassword', this.fields)
        		.then((response) => {
        			// Toggle loader
        			this.isSaving = false;
        			// Clear form
        			Helpers.resetForm(this.fields);
        			this.clear();        				
      				// A password was updated
      				this.$emit('saved');
        		});
        }
      },
      clear () {
        this.$refs.form.reset()
      }
    },

    created () {
    	// If user is present then its an update from
    	if(this.user) {
    		// Change dispatch action
    		this.fields.id = user.id;
    	}
    }

  }
</script>

<style>

</style>