<template>
	<div>
	  <!-- Image input setup -->
	  <v-btn @click="onPickImage" class="ml-0 info">
	  	Select Image
	  </v-btn>
	  <input
	  	@change="onImageSelected"
	  	type="file"
	  	style="display:none;"
	  	ref="imageInput"
	  	accept="image/*"
	  >
	  <!-- / Avatar image input -->
	  <!-- Avatar preview -->
    <v-list v-if="imageBase64 != ''" subheader>
      <v-subheader>Preview</v-subheader>
        <v-list-tile avatar>
          <v-list-tile-avatar>
            <img :src="imageBase64"/>
          </v-list-tile-avatar>
          <v-list-tile-content>
            <v-list-tile-title>{{ imageFileName }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
    </v-list>       
    <!-- / Avatar preview -->		
	</div>
</template>

<script>
	export default {
    props: ['clear'],

		data: () => ({
			// For image preview
      imageBase64: '',
      imageFileName: '',
		}),

    watch: {
      clear (value) {
        if(value === '') {
          this.imageBase64 = '';
          this.imageFileName = '';          
        }
      }
    },

		methods: {
      onPickImage () {
      	this.$refs.imageInput.click();
      },
      onImageSelected (event) {
      	// Get the upload files (only 1)
      	const files = event.target.files;
      	// Cache filename
      	let filename = files[0].name;

      	// Ensure image has extension
      	if(filename.lastIndexOf('.') <= 0) {
      		return false;
      	}
      	// Create JS file reader
      	const fileReader = new FileReader();
      	// Get a base64 string of image (for preview)
      	fileReader.addEventListener('load', () => {
      		this.imageBase64 = fileReader.result;
	      	// Cache filename for preview
	      	this.imageFileName = filename;       		
	      	// Emit event to parent with base64 image file
	      	this.$emit('image-selected', fileReader.result);      		
      	});
      	fileReader.readAsDataURL(files[0]);
      }
		}
	}
</script>