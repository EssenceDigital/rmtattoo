<template>
	<div>
		<!-- Top toolbar -->
		<v-toolbar card dark prominent>
      <v-toolbar-title class="headline primary--text mr-5">
      	Portfolio
      </v-toolbar-title>
      <v-btn
				@click="addImageDialog = true"
      	flat
      >
        <v-icon left>
        	add_a_photo
        </v-icon>
        Image
      </v-btn>
			<v-btn
				@click="addArtistDialog = true"
      	flat
      >
        <v-icon left>
        	add
        </v-icon>
        Portfolio Artist
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
        	<portfolio-form @saved="addImageDialog = false"></portfolio-form>
        </v-card-text>
      </v-card>
    </v-dialog>

		<!-- Add artist dialog -->
    <v-dialog v-model="addArtistDialog" persistent max-width="500px">
      <v-card>
        <v-card-title>
          <span class="subheading">Add artist</span>
          <v-spacer></v-spacer>
          <v-btn
          	@click="addArtistDialog = false"
          	icon
          >
          	<v-icon>close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
        	<!-- Form to add image -->
					<artist-form @saved="addArtistDialog = false"></artist-form>
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
			}
		},

		data: () => ({
			addImageDialog: false,
			addArtistDialog: false
		}),

		created () {
			this.$store.dispatch('getPortfolioImages');
			this.$store.dispatch('getPortfolioArtists');
		}
	}
</script>
