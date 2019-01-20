<template>
	<v-container fluid>
		<!-- Form -->
		<v-form v-model="valid" ref="form" lazy-validation>
		  <v-text-field
		  	class="mt-2"
		    label="Name"
		    v-model="fields.name"
		    :rules="rules.name"
		    :counter="30"
		    required
		    :disabled="name != null"
		  ></v-text-field>
		  <v-text-field
		  	class="mt-2"
		    label="Email"
		    v-model="fields.email"
		    :rules="rules.email"
		    :counter="50"
		    required
		  ></v-text-field>
			<v-select
        :items="[
        	{ text: 'User', value: 'user' },
        	{ text: 'Admin', value: 'admin' }
        ]"
        v-model="fields.role"
		    :rules="rules.role"
        label="Role..."
        class="mt-3"
        single-line
        auto
        prepend-icon="lock_outline"
        hide-details
      ></v-select>

      <div v-if="!user">
	      <v-divider class="mt-5 mb-3"></v-divider>
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
      </div>
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
			  	v-if="user"
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
		      <v-card-title class="subheading">Remove user?</v-card-title>
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
  	props: ['user', 'name'],

    data: () => ({
      valid: false,
      isSaving: false,
      isRemoving: false,
      removeDialog: false,
      dispatchAction: 'createUser',
      // Form data
      fields: {
      	id: '',
      	name: '',
      	email: '',
      	password: '',
      	password_confirmation: '',
      	role: ''
      },

      // Validation rules
      rules: {
	      name: [
	        (v) => !!v || 'Name is required',
	        (v) => v && v.length <= 15 || 'Name must be less than 30 characters'
	      ],
	      email: [
	        (v) => !!v || 'Email is required',
	        (v) => v && v.length <= 30 || 'Email must be less than 50 characters'
	      ],
	      password: [
	        (v) => !!v || 'Password is required',
	        (v) => v && v.length <= 30 || 'Password must be less than 30 characters'
	      ],
	      password_confirmation: [
	        (v) => !!v || 'Password confirmation is required',
	        (v) => v && v.length <= 30 || 'Password confirmation must be less than 30 characters'
	      ],
	      role: [
	        (v) => !!v || 'Role is required'
	      ]
      }
    }),



    watch: {
    	user (value){
    		if(value.id){
	    		// Change dispatch action
	    		this.dispatchAction = 'updateUser';
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
        			if(! this.user){
	        			// Clear form
	        			Helpers.resetForm(this.fields);
	        			this.clear();
        			}
      				// A user was updated
      				this.$emit('saved');
        		})
						.catch((response) => {
							// Toggle loader
        			this.isSaving = false;
							console.log(response);							
						});
        }
      },
      remove () {
      	// Toggle loader
      	this.isRemoving = true;
      	// Dispatch event to store
      	this.$store.dispatch('removeUser', this.fields.id)
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
    	if(this.user) {
    		// Change dispatch action
    		this.dispatchAction = 'updateUser';
    		// Populate Form
    		Helpers.populateForm(this.fields, this.user);
    		// Show save button
    		this.valid = true;
    	}

    	// If the name is present set it in the form
    	if(this.name){
    		this.fields.name = this.name;
    	}

    }

  }
</script>

<style>

</style>
