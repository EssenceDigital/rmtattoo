<template>
	<div>
		<!-- Top toolbar -->
		<v-toolbar card dark prominent>
      <v-toolbar-title class="headline primary--text mr-5">
      	Artist
      </v-toolbar-title>
      <v-btn
				color="primary"
				@click="artistDialog = true"
      >
        <v-icon left>
        	note_add
        </v-icon>
        Artist
      </v-btn>
			<v-btn
				color="primary"
				class="ml-3"
				@click="viewArtists"
      >
        <v-icon left>
        	edit
        </v-icon>
        Artists
      </v-btn>
    </v-toolbar>
    <!-- / Top toolbar -->
    <v-divider></v-divider>
		<!-- / Faq expansion panel container -->

		<!-- Artist dialog -->
    <v-dialog v-model="artistDialog" persistent max-width="500px">
      <v-card>
        <v-card-title>
          <span class="subheading"></span>
          <v-spacer></v-spacer>
          <v-btn
          	@click="closeArtistDialog"
          	icon
          >
          	<v-icon>close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
					<v-container fluid v-if="editArtists">
						<v-select
							:items="artistsSelectList"
							v-model="selectedArtist"
							label="Artist..."
							single-line
							auto
							hide-details
						>
						</v-select>
					</v-container>

        	<!-- Form to add image -->
					<artist-form
						:artist="selectedArtist"
						@saved="closeArtistDialog"
					></artist-form>
        </v-card-text>
      </v-card>
    </v-dialog>
	</div>

</template>

<script>
	import ArtistForm from './../bookings/Artist-form';

	export default {
		components: {
			'artist-form': ArtistForm
		},

		computed: {
			artistsSelectList (){
				return this.$store.getters.bookingArtistsSelectListFull;
			}
		},

		data: () => ({
			selectedArtist: '',
			artistDialog: false,
			editArtists: false
		}),

		methods: {
			viewArtists (){
				this.editArtists = true;
				this.artistDialog = true;
			},

			closeArtistDialog (){
				// Reset artist
				this.selectedArtist = '';
				// Close dialog
				this.artistDialog = false;
				this.editArtists = false;
			}
		},

		created () {
			this.$store.dispatch('getBookingArtists');
		}
	}
</script>
