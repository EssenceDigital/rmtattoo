<template>
	<div>
	  <v-card flat tile>
	  	<silentbox-single :src="'storage/' + image.src" description="">
	      <v-card-media
	        :src="'storage/' + image.src"
	        height="150px"
	      >
	      </v-card-media>	
					<v-btn
	        color="error"
	        dark
	        small
	        absolute
	        top
	        right
	        fab
	        @click.native.stop="showRemoveDialog(image.id)"
	      >
	        <v-icon>delete_sweep</v-icon>
	      </v-btn>		                  		
	  	</silentbox-single>	
	  </v-card>	

		<!-- Remove dialog -->
		<v-layout v-if="removeDialog" row justify-center>
		  <v-dialog v-model="removeDialog" persistent>
		    <v-card>
		      <v-card-title class="subheading">Remove image?</v-card-title>
		      <v-card-actions>
		        <v-spacer></v-spacer>
		        <v-btn color="green darken-1" flat @click.native="hideRemoveDialog">Maybe Not</v-btn>
		        <v-btn 
		        	@click.native="remove()"		        
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

	</div>
</template>

<script>
	import PortfolioForm from './Portfolio-form';

	export default {
		props: ['image'],

		data: () => ({
			removeDialog: false,
			idToRemove: '',
      isRemoving: false		
		}),

		methods: {
			showRemoveDialog (id) {
				// Set ID for removal
				this.idToRemove = id;
				// Toggle dialog
				this.removeDialog = true;
			},

			hideRemoveDialog () {
				// Clear set ID
				this.idToRemove = '';
				// Toggle dialog
				this.removeDialog = false;
			},

      remove () {
      	// Toggle loader
      	this.isRemoving = true;
      	// Dispatch event to store
      	this.$store.dispatch('removePortfolioImage', this.idToRemove)
      		.then(() => {
      			// Toggle loader
      			this.isRemoving = false;
      		});
      }			
		}
	}
</script>