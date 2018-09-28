<template>
  <v-card v-if="users">
    <v-card-title>
     	Users
      <v-spacer></v-spacer>
      <v-text-field
        append-icon="search"
        label="Search"
        single-line
        hide-details
        v-model="search"
      ></v-text-field>
    </v-card-title>
    <v-data-table
        :items="users"
        :search="search"
      >
      <template slot="headers" slot-scope="props">
      	<th class="text-xs-left primary--text">Name</th>
      	<th class="text-xs-left primary--text">Email</th>
      	<th class="text-xs-left primary--text">Role</th>
      	<th class="text-xs-right primary--text">Actions</th>
      </template>
      <template slot="items" slot-scope="props">
      	<tr>
	        <td class="text-xs-left">{{ props.item.name }}</td>
	        <td class="text-xs-left">{{ props.item.email }}</td>
	        <td class="text-xs-left">{{ props.item.role }}</td>
	        <td class="text-xs-right">
						<v-menu bottom left>
	            <v-btn icon slot="activator">
	              <v-icon>more_vert</v-icon>
	            </v-btn>
	            <v-list>
	              <v-list-tile @click="showEditDialog(props.item.id, 'editUserDialog')">
	                <v-list-tile-title>Edit</v-list-tile-title>
	              </v-list-tile>  
	              <v-list-tile @click="showEditDialog(props.item.id, 'editPasswordDialog')">
	                <v-list-tile-title>Password</v-list-tile-title>
	              </v-list-tile>	                          	              
	            </v-list>
	          </v-menu>	        	
	        </td>      	 	
      	</tr>
      </template>      
      <template slot="pageText" slot-scope="{ pageStart, pageStop }">
        From {{ pageStart }} to {{ pageStop }}
      </template>
    </v-data-table>

		<!-- Edit user dialog -->
	  <v-layout row justify-center>
	    <v-dialog v-model="editUserDialog" persistent max-width="500px">
	      <v-card>
	        <v-card-title>
	          <span class="subheading">Edit user</span>
	          <v-spacer></v-spacer>
	          <v-btn 
	          	@click="editUserDialog = false"
	          	icon
	          >
	          	<v-icon>close</v-icon>
	          </v-btn>
	        </v-card-title>
	        <v-card-text>
	        	<user-form @saved="editUserDialog = false" :user="user"></user-form>
	        </v-card-text>
	      </v-card>
	    </v-dialog>
	  </v-layout>
	  <!-- /edit user dialog -->	 

		<!-- Edit password dialog -->
	  <v-layout row justify-center>
	    <v-dialog v-model="editPasswordDialog" persistent max-width="500px">
	      <v-card>
	        <v-card-title>
	          <span class="subheading">Change a password</span>
	          <v-spacer></v-spacer>
	          <v-btn 
	          	@click="editPasswordDialog = false"
	          	icon
	          >
	          	<v-icon>close</v-icon>
	          </v-btn>
	        </v-card-title>
	        <v-card-text>
	        	<change-password-form @saved="editPasswordDialog = false" :user="user"></change-password-form>
	        </v-card-text>
	      </v-card>
	    </v-dialog>
	  </v-layout>
	  <!-- /edit password dialog -->	

  </v-card>	
</template>

<script>
	import Helpers from './../../resources/helpers';
	import UserForm from './User-form';
	import ChangePasswordForm from './Change-password-form';

	export default {
		data: () => ({
			search: '',
			editUserDialog: false,
			editPasswordDialog: false,
			user: false
		}),

		components: {
			'user-form': UserForm,
			'change-password-form': ChangePasswordForm
		},

		computed: {
			users () {
				return this.$store.getters.users;
			}
		},

		methods: {
			showEditDialog (id, dialog) {
				// Set up the user to be edited
				let index = Helpers.pluckObjectById(this.users, 'id', id);
				this.user = this.users[index];
				// Show edit dialog
				this[dialog] = true;
			}
		},

		created () {
			// Dispatch event to retrieve bookings
			this.$store.dispatch('getUsers');
		}
	}
</script>

<style>

</style>