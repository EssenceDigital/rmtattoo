<template>
	<div>
		<!-- Top toolbar -->
		<v-toolbar card dark prominent>
      <v-toolbar-title class="headline primary--text mr-5">
      	FAQs
      </v-toolbar-title>
      <v-btn
				color="primary"
				@click="addFaqDialog = true"
      >
        <v-icon left>
        	note_add
        </v-icon>
        FAQ
      </v-btn>
    </v-toolbar>
    <!-- / Top toolbar -->
    <v-divider></v-divider>
    <!-- Faq expansion panel container -->
		<v-container fluid class="mt-4 pb-5">
			<v-layout row>
				<faqs-expansion :faqs="faqs"></faqs-expansion>
			</v-layout>
		</v-container>
		<!-- / Faq expansion panel container -->
		<!-- Add faq dialog -->
	  <v-layout row justify-center>
	    <v-dialog v-model="addFaqDialog" persistent max-width="750px">
	      <v-card>
	        <v-card-title>
	          <span class="subheading">Add question</span>
	          <v-spacer></v-spacer>
	          <v-btn
	          	@click="addFaqDialog = false"
	          	icon
	          >
	          	<v-icon>close</v-icon>
	          </v-btn>
	        </v-card-title>
	        <v-card-text>
	  				<faq-form @saved="addFaqDialog = false"></faq-form>
	        </v-card-text>
	      </v-card>
	    </v-dialog>
	  </v-layout>
	  <!-- /Add faq dialog -->
	</div>

</template>

<script>
	import FaqsExpansion from './../faqs/Faqs-expansion';
	import FaqForm from './../faqs/Faq-form';

	export default {
		components: {
			'faqs-expansion': FaqsExpansion,
			'faq-form': FaqForm
		},

		computed: {
			faqs () {
				return this.$store.getters.faqs;
			}
		},

		data: () => ({
			addFaqDialog: false
		}),

		created () {
			this.$store.dispatch('getFaqs');
		}
	}
</script>
