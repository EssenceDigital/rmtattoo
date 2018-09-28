<template>
	<v-expansion-panel v-if="faqs">
		<!-- Faq element -->
		<v-expansion-panel-content v-for="faq in faqs" :key="faq.id">
	    <div slot="header">{{ faq.question }}</div>
	    <v-card>
	      <v-card-text class="grey lighten-3 black--text" style="white-space: pre-line;">
	      	<v-layout row class="pl-3">
	      		<v-flex xs11>
	      			{{ faq.answer }}
	      		</v-flex>
	      		<v-flex xs1>
	      			<v-btn icon @click="showEditDialog(faq)" class="ml-4">
	      				<v-icon class="black--text">edit</v-icon>
	      			</v-btn>
	      		</v-flex>
	      	</v-layout>
	      </v-card-text>
	    </v-card>
			<!-- Edit faq dialog -->
		  <v-layout row justify-center>
		    <v-dialog v-model="editFaqDialog" persistent max-width="750px">
		      <v-card>
		        <v-card-title>
		          <span class="subheading">Edit question</span>
		          <v-spacer></v-spacer>
		          <v-btn 
		          	@click="hideEditDialog"
		          	icon
		          >
		          	<v-icon>close</v-icon>
		          </v-btn>
		        </v-card-title>
		        <v-card-text>
		  				<faq-form :faq="currentFaq" @saved="hideEditDialog"></faq-form>
		        </v-card-text>
		      </v-card>
		    </v-dialog>
		  </v-layout>
		  <!-- /Edit faq dialog -->
		</v-expansion-panel-content>					
	</v-expansion-panel>
</template>

<script>
	import FaqForm from './../faqs/Faq-form';

	export default {
		props: ['faqs'],

		data: () => ({
			editFaqDialog: false,
			currentFaq: ''
		}),

		components: {
			'faq-form': FaqForm
		},

		methods: {
			showEditDialog (faq) {
				// Set current faq
				this.currentFaq = faq;			
				// Toggle dialog
				this.editFaqDialog = true;

			},

			hideEditDialog (){
				// Toggle dialog
				this.editFaqDialog = false;
				// Set current faq
				this.currentFaq = '';				
			}
		}
	}
</script>