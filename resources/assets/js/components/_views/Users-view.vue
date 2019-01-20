/*
 * Users view. Holds all user related actions.
*/
<template>
	<div>
		<!-- Top toolbar -->
		<v-toolbar card dark prominent>
      <v-toolbar-title class="headline primary--text mr-5">
      	Users
      </v-toolbar-title>
      <v-btn
        color="primary"
				@click="addUserDialog = true"
      >
        <v-icon left>
        	person_add
        </v-icon>
        User
      </v-btn>
    </v-toolbar>
    <!-- / Top toolbar -->
    <v-divider></v-divider>
    <!-- Users table container -->
		<v-container fluid class="mt-4 pb-5">
			<v-layout row wrap>
				<v-flex xs12>
					<users-table></users-table>
				</v-flex>
			</v-layout>
		</v-container>
		<!-- / Users table container -->
		<!-- Add user dialog -->
	  <v-layout row justify-center>
	    <v-dialog v-model="addUserDialog" persistent max-width="500px">
	      <v-card>
	        <v-card-title>
	          <span class="subheading">Create user</span>
	          <v-spacer></v-spacer>
	          <v-btn
	          	@click="addUserDialog = false"
	          	icon
	          >
	          	<v-icon>close</v-icon>
	          </v-btn>
	        </v-card-title>
	        <v-card-text>
	        	<user-form @saved="addUserDialog = false"></user-form>
	        </v-card-text>
	      </v-card>
	    </v-dialog>
	  </v-layout>
	  <!-- /Add user dialog -->
	</div>

</template>

<script>
	import UserForm from './../users/User-form';
	import UsersTable from './../users/Users-table';

	export default {
		components: {
			'user-form': UserForm,
			'users-table': UsersTable
		},

		data: () => ({
			addUserDialog: false
		})
	}
</script>
