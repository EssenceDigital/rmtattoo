<template>
	<div>
		<!-- Top toolbar -->
		<v-toolbar card dark prominent>
      <v-toolbar-title class="headline primary--text mr-5">
      	Your Bookings
      </v-toolbar-title>
    </v-toolbar>
    <!-- / Top toolbar -->
    <v-divider></v-divider>
    <!-- Booking table container -->
		<v-container fluid class="mt-4 pb-5">
			<v-layout row>
				<v-flex xs12>
					<users-bookings-table></users-bookings-table>
				</v-flex>
			</v-layout>
		</v-container>   
		<!-- / Bookings table container -->	 	
	</div>

</template>

<script>
	import UsersBookingsTable from './../bookings/Users-bookings-table';

	export default {
		components: {
			'users-bookings-table': UsersBookingsTable
		}
	}
</script>