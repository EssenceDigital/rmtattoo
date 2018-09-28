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
	  <v-layout row justify-center>
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
	  </v-layout>
	  <!-- /Add image dialog -->	 	
	</div>	
</template>

<script>
	import PortfolioForm from './../portfolio/Portfolio-form';
	import ImageCard from './../portfolio/Image-card';

	export default {
		components: {
			'image-card': ImageCard,
			'portfolio-form': PortfolioForm
		},

		computed: {
			images () {
				return this.$store.getters.portfolioImages;
			}
		},

		data: () => ({
			addImageDialog: false
		}),

		created () {
			this.$store.dispatch('getPortfolioImages');
		}
	}	
</script>