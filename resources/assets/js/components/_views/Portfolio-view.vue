<template v-if="images && artistsSelectList">
	<div>
		<!-- Top toolbar -->
		<v-toolbar card dark prominent>
      <v-toolbar-title class="headline primary--text mr-5">
      	Portfolio
      </v-toolbar-title>
      <v-btn
				color="primary"
				@click="addImageDialog = true"
      >
        <v-icon left>
        	add_photo_alternate
        </v-icon>
				Image
      </v-btn>
			<v-btn
				color="primary"
				class="ml-3"
				@click="artistDialog = true"
      >
        <v-icon left>
        	edit
        </v-icon>
        Artists
      </v-btn>
    </v-toolbar>
    <!-- / Top toolbar -->
    <v-divider></v-divider>
    <!-- Portfolio container -->
		<v-container fluid grid-list-sm class="mt-4 pb-5">
			<v-layout row wrap>
				<v-flex
				  xs3
				  v-for="image in images"
				  :key="image.id"
				>
					<image-card :image="image"></image-card>
				</v-flex>
			</v-layout>
		</v-container>
		<!-- / Portfolio container -->

		<!-- Add image dialog -->
    <v-dialog v-model="addImageDialog" persistent max-width="500px">
      <v-card>
        <v-card-title>
          <span class="subheading">Add image</span>
          <v-spacer></v-spacer>
          <v-btn
          	@click="addImageDialog = false"
          	icon
          >
          	<v-icon>close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
        	<!-- Form to add image -->
        	<portfolio-form
						@saved="closeArtistDialog"
						@add-artist="artistDialog = true"
					></portfolio-form>
        </v-card-text>
      </v-card>
    </v-dialog>

		<!-- Edit artist dialog -->
    <v-dialog v-model="artistDialog" persistent max-width="500px">
      <v-card>
        <v-card-title>
          <span class="subheading">Add artist</span>
          <v-spacer></v-spacer>
          <v-btn
          	@click="closeArtistDialog"
          	icon
          >
          	<v-icon>close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
					<v-container fluid>
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
	import PortfolioForm from './../portfolio/Portfolio-form';
	import ArtistForm from './../portfolio/Artist-form';
	import ImageCard from './../portfolio/Image-card';

	export default {
		components: {
			'image-card': ImageCard,
			'portfolio-form': PortfolioForm,
			'artist-form': ArtistForm
		},

		computed: {
			images () {
				return this.$store.getters.portfolioImages;
			},
			artistsSelectList (){
				return this.$store.getters.portfolioArtistsSelectListFull;
			}
		},

		data: () => ({
			addImageDialog: false,
			artistDialog: false,
			selectedArtist: ''
		}),

		methods: {
			closeArtistDialog (){
				// Reset artist
				this.selectedArtist = '';
				// Close dialog
				this.artistDialog = false;
			}

		},

		created () {
			this.$store.dispatch('getPortfolioImages');
			this.$store.dispatch('getPortfolioArtists');
		}
	}
</script>
