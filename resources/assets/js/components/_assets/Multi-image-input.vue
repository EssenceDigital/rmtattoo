<template>
	<div>
	  <!-- Image input setup -->
    <button class="btn btn-primary hvr-in" @click="onPickImage">Add Reference Images</button>
	  <input
	  	@change="onImageSelected"
	  	type="file"
	  	style="display:none;"
	  	ref="imageInput"
	  	accept="image/*"
      multiple="multiple"
	  >
	</div>
</template>

<script>
	export default {
    props: ['websiteState'],
    
		methods: {
      onPickImage () {
      	this.$refs.imageInput.click();
      },

      processImage () {

      },

      onImageSelected (event) {
      	// Get the upload files
      	const files = event.target.files;
        // For each file selected
        Array.from(files).forEach((file) => {
          // Set up the image object
          let image = {
            base64: '',
            filename: ''
          };
          // Cache filename
          let filename = file.name;
          // Ensure image has extension
          if(filename.lastIndexOf('.') <= 0) {
            return false;
          }
          // Create JS file reader
          let fileReader = new FileReader();
          // Get a base64 string of image (for preview)
          fileReader.addEventListener('load', () => {            
            // Cache image
            image.base64 = fileReader.result;
            // Cache filename for preview
            image.filename = filename;
            // Emit event to parent with base64 image file
            this.$emit('image-added', image);               
       
          });
          fileReader.readAsDataURL(file);
        });
      }
      
		}
	}
</script>