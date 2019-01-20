/*
 * Used by the website to create a booking
 *
 * Contains the booking form and all related logic.
*/
<template>
	<!-- Component container -->
	<div>
			<div v-if="!showForm" class="row">
				<div class="service-col mb30">
				    <div class="service-thumb">
				        <img class="img-responsive" src="_site-assets/images/bookings/bookings-1.jpg" alt="">
				    </div>
				    <div class="service-content">
				        <div class="service-header">
				            <h2>Booking Requests</h2>
				        </div>
				        <div class="clearfix"></div>
				        <p>You want your tattoo as soon as possible, and we legitimately understand. Thankfully, we've created a simple form that allows us to proccess your booking smoothly and ensures you get the peice you want.</p>
				        <p>
				        <p class="gold-text mt-10">
				        	Please only complete this form if you are serious about getting tatooed.
				        </p>
				        <div class="service-btn">
			            <button @click="showForm = true" class="btn btn-primary sbtn-hvr-out mt-20">
				            <span>
				            	Start a booking now
				            </span>
				            <span class="time"><i class="fa fa-clock-o"></i> 5 min</span>
			            </button>
				        </div>
				    </div>
				</div>
			</div>

		<transition name="fade">
		  <!-- Booking form -->
		  <div v-if="showForm" class="booking-form">
		    <!-- Client details -->
		    <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <img src="_site-assets/images/title-img/title-img-4.png" class="title-img mb15" alt="">
                        <h3 class="title">Request <strong>Booking</strong></h3>
                    </div>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
		    	<!-- Horizontal rule (break) -->
			    <div class="row">
			    	<hr class="grey-border">
			    </div>
			    <!-- / Horizontal rule (break) -->
			    <!-- Title row -->
			    <div class="row">
			    	<h3 class="subtitle">Your Details</h3>
			    </div>
			    <!-- / Title row -->
			    <!-- Inputs row -->
			    <div class="row mt-15">
			    	<!-- Input col -->
			      <div class="col-md-6">
			        <div class="form-group">
			          <input v-model="fields.first.val" type="text" class="form-control" placeholder="First name...">
			          <div class="help-block with-errors gold-text">{{ fields.first.errMsg }}</div>
			        </div>
			      </div>
			      <!-- / Input col -->
			      <!-- Input col -->
			      <div class="col-md-6">
			        <div class="form-group">
			          <input v-model="fields.last.val" type="text" class="form-control" placeholder="Last name...">
			          <div class="help-block with-errors gold-text">{{ fields.last.errMsg }}</div>
			        </div>
			      </div>
			      <!-- / Input col -->
			    </div>
			    <!-- / Inputs row -->
			    <!-- Inputs row -->
			    <div class="row">
			    	<!-- Input col -->
			      <div class="col-md-6">
			        <div class="form-group">
			          <input v-model="fields.phone.val" type="text" class="form-control" placeholder="Phone number...">
			          <div class="help-block with-errors gold-text">{{ fields.phone.errMsg }}</div>
			        </div>
			      </div>
			      <!-- / Input col -->
			      <!-- Input col -->
			      <div class="col-md-6">
			        <div class="form-group">
			          <input v-model="fields.email.val" type="text" class="form-control" placeholder="Email address...">
			          <div class="help-block with-errors gold-text">{{ fields.email.errMsg }}</div>
			        </div>
			      </div>
			      <!-- / Input col -->
			    </div>
			    <!-- / Inputs row -->
			  </div>
			  <!-- / Client details -->

			  <!-- Tattoo details -->
			  <div class="container-fluid">
			  	<!-- Horizontal rule (break) -->
			    <div class="row">
			    	<hr class="grey-border">
			    </div>
			    <!-- / Horizontal rule (break) -->
			    <!-- Title row -->
			    <div class="row mb-4">
			    	<h3 class="subtitle">About The Tattoo</h3>
			    </div>
			    <!-- / Title row -->
			    <!-- Inputs row -->
			    <div class="row mt-15">
			    	<!-- Input col -->
			    	<div class="col-md-6">
			    		<div class="form-group">
			          <select v-model="fields.artist.val" class="form-control">
			            <option value="">Prefered Artist...</option>
			            <option v-for="artist in artists" :value="artist.name">
			            	{{ artist.name }}
			            </option>
			          </select>
			          <div class="help-block with-errors gold-text">{{ fields.artist.errMsg }}</div>
			    		</div>
			    	</div>
			    	<!-- / Input col -->
			    	<!-- Input col -->
			      <div class="col-md-6">
			        <div class="form-group">
			          <input v-model="fields.tattoo_size.val" type="text" class="form-control" placeholder="Tattoo size...">
			          <div class="help-block with-errors gold-text">{{ fields.tattoo_size.errMsg }}</div>
			        </div>
			      </div>
			      <!-- / Input col -->
			    </div>
			    <!-- / Inputs row -->
			    <!-- Inputs row -->
			    <div class="row">
			    	<!-- Input col -->
			      <div class="col-md-6">
			        <div class="form-group">
			          <input v-model="fields.location.val" type="text" class="form-control" placeholder="Location...">
			          <div class="help-block with-errors gold-text">{{ fields.location.errMsg }}</div>
			        </div>
			      </div>
			      <!-- / Input col -->
			      <!-- Input col -->
			      <div class="col-md-6">
			        <div class="form-group">
			          <input v-model="fields.description.val" type="text" class="form-control" placeholder="Description...">
			          <div class="help-block with-errors gold-text">{{ fields.description.errMsg }}</div>
			        </div>
			      </div>
			      <!-- / Input col -->
			    </div>
			    <!-- / Inputs row -->
			    <!-- Inputs row -->
			    <div class="row">
			    	<!-- Input col -->
			    	<div class="col-md-6">
			    		<div class="form-group">
			          <select v-model="fields.color_preference.val"class="form-control">
			            <option value="">Color preference...</option>
			            <option value="Color">Color</option>
			            <option value="Black-and-grey">Black & Grey</option>
			          </select>
			          <div class="help-block with-errors gold-text">{{ fields.color_preference.errMsg }}</div>
			    		</div>
			    	</div>
			    	<!-- / Input col -->
			    	<!-- Input col -->
			    	<div class="col-md-6">
			    		<div class="form-group">
			          <select v-model="fields.tattoo_style.val"class="form-control">
			            <option value="">Style...</option>
			            <option value="Traditional">Traditional</option>
			            <option value="Realistic">Realistic</option>
			          </select>
			          <div class="help-block with-errors gold-text">{{ fields.tattoo_style.errMsg }}</div>
			    		</div>
			    	</div>
			    	<!-- / Input col -->
			    </div>
			    <!-- / Inputs row -->
			    <!-- Inputs row -->
			    <div class="row">
			    	<!-- Input col -->
			      <div class="col-md-6">
			        <div class="form-group">
			          <input v-model="fields.budget.val" type="text" class="form-control" placeholder="Budget...">
			          <div class="help-block with-errors gold-text">{{ fields.budget.errMsg }}</div>
			        </div>
			      </div>
			      <!-- / Input col -->
			      <!-- Input col -->
			      <div class="col-md-6">
			        <div class="form-group">
			          <image-input
			          	@image-added="imageAdded"
			          >
			          </image-input>
			          <div class="help-block">Max: 3</div>
			          <span v-if="this.fields.images.err" class="gold-text">{{ this.fields.images.errMsg }}</span>
			        </div>
			      </div>
			      <!-- / Input col -->
			    </div>
			    <!-- / Inputs row -->
			  </div>
			  <!-- / Tattoo details -->

			  <!-- Image previews -->
			  <div class="contanier-fluid">
			    <!-- Image preview pane -->
			    <div v-if="this.fields.images.val.length > 0" class="row">
			    	<!-- Image preview for each image -->
			    	<div v-for="image in this.fields.images.val" class="col-md-4 text-center">
			    		<div class="row mb15">
			    			<i @click="removeImage(image)"
			    				class="fa fa-window-close gold-text close-icon"
			    			></i>
			    		</div>
			    		<img :src="image" class="image-preview"><br>
			    	</div>
			    	<!--/ Image preview -->
			    </div>
			    <!-- / Image preview pane -->
			  </div>
			  <!-- / Image previews -->

				<div class="container-fluid">
			  	<!-- Horizontal rule (break) -->
			    <div class="row">
			    	<hr class="grey-border">
			    </div>
			    <!-- / Horizontal rule (break) -->
			    <!-- Captcha row -->
			    <div class="row">
			    	<!-- Input col -->
			      <div class="col-md-6">
			        <div class="form-group">
			          <input v-model="fields.captcha.val" type="text" class="form-control" :placeholder="captcha">
			          <div class="help-block with-errors gold-text">{{ fields.captcha.errMsg }}</div>
			        </div>
			      </div>
			      <!-- / Input col -->
			    </div>
			    <!-- / Captcha row -->
				</div>

			  <!-- Submit button -->
		    <div class="row mt-35">
		    	<div class="col-md-12">
		    		<button @click="submit" class="btn btn-primary hvr-in" id="send-booking-btn">
		    			<span v-if="!isSaving">Let's Do This</span>
		    			<span v-if="isSaving"><i class="fa fa-spinner fa-spin fa-fw"></i></span>
		    		</button>
		    	</div>
		    </div>
		    <!-- / Submit button -->
		  </div>
		</transition>


	  <!-- Success alert -->
	  <transition name="fade">
		  <div v-if="hasSaved" id="success-alert">
		  	<div class="row text-center">
		  		<i class="fa fa-check-circle"></i>
		  		<h3>Your booking request has been recieved!</h3>
		  		<em><h5 class="mt5">We will contact you as soon as we are able to.</h5></em>
		  	</div>
		  </div>
	  </transition>
	  <!-- / Success alert -->

	</div>
	<!-- / Component container -->
</template>

<script>
	import api from './../../resources/api';
	import ImageInput from './../_assets/Multi-image-input';

	export default {
		props: ['captcha'],

    data: () => ({
    	// If the form is shown or not
    	showForm: false,

    	// Form is saving to db
      isSaving: false,
      // Form has saved to db
      hasSaved: false,
      // Form data
      fields: {
      	id: { val: '', err: false, errMsg: '', dflt: '' },
      	first: { val: '', err: false, errMsg: '', dflt: '' },
      	last: { val: '', err: false, errMsg: '', dflt: '' },
      	phone: { val: '', err: false, errMsg: '', dflt: '' },
      	email: { val: '', err: false, errMsg: '', dflt: '' },
      	artist: { val: '', err: false, errMsg: '', dflt: '' },
      	tattoo_size: { val: '', err: false, errMsg: '', dflt: '' },
      	description: { val: '', err: false, errMsg: '', dflt: '' },
      	location: { val: '', err: false, errMsg: '', dflt: '' },
      	color_preference: { val: '', err: false, errMsg: '', dflt: '' },
      	tattoo_style: { val: '', err: false, errMsg: '', dflt: '' },
      	budget: { val: '', err: false, errMsg: '', dflt: '' },
      	images: { val: [], err: false, errMsg: '', dflt: [] },
      	captcha: { val: '', err: false, errMsg: '', dflt: ''}
      },
      // For the artists select list
      artists: []
    }),

    components: {
    	'image-input': ImageInput
    },

    methods: {
    	/*
    	 * Pushes an image to the images field value.
    	 * @param image base64 - The image passed from the image input component
    	*/
    	imageAdded (image) {
    		// Only add image if there is less than 3 currently
    		if(this.fields.images.val.length < 3){
	    		// Cache the images in form field
	    		this.fields.images.val.push(image.base64);
    		} else  {
    			// Flag error if there is already 3 images
    			this.fields.images.err = true;
    			this.fields.images.errMsg = 'We only need three images!';
    		}
    	},

    	/*
			 * Removes an image from the images field value.
			 * @param image base64 - The image to find the index of and remove
    	*/
    	removeImage (image) {
    		// Get index of image to remove
    		let index = this.fields.images.val.indexOf(image);
    		// Remove from array
    		return this.fields.images.val.splice(index, 1);
    	},

    	/*
			 *
    	*/
    	validate () {
    		// Itterate over fields
    		for(let key in this.fields){
    			// Skip ID field
    			if(key === 'id') continue;
    			// Skip images field
    			if(key === 'images') continue;
    			// Skip artist field
    			if(key === 'artist') continue;
    			// If the field is blank or less than 3 chars then mark as error state
    			if(this.fields[key].val == ''){
    				this.fields[key].err = true;
    				this.fields[key].errMsg = 'Field is required.';
    			} else {
    				// If field is not blank and greater then 3 chars then clear any potential error state
    				this.fields[key].err = false;
    				this.fields[key].errMsg = '';
    			}
    		}
    	},

    	/*
	  	 * Saves the form to the database
    	*/
    	submit () {
    		// Validate form first
    		this.validate();
    		// Will be data to send in POST
    		let data = {};
    		// Populate data from fields
				for(let key in this.fields){
					// Stop processing if any field is in error
					if(this.fields[key].err){
						return false;
					}
					data[key] = this.fields[key].val;
				}
    		// Toggle loader
    		this.isSaving = true;
				// Send request to server
				axios.post('/bookings/start', data)
					/*
					 * Success
					*/
					.then((response) => {
						// Toggle loader
						this.isSaving = false;
						// Clear the form too when successful
						for(let key in this.fields){
							this.fields[key].val = this.fields[key].dflt;
							this.fields[key].err = false;
							this.fields[key].errMsg = '';
						}
						// Toggle saved flag
							this.hasSaved = true;
							// Toggle saved flag after 3 secs
							setTimeout(() => {
								this.hasSaved = false;
							}, 3000);
					})
					/*
					 * Errors
					*/
					.catch((errors) => {
						// Toggle loader
						this.isSaving = false;
						// Populate form erros if there is any
						if(errors.response.data.errors){
							let flags = errors.response.data.errors;
							// Set up error values
							for(let key in flags){
								this.fields[key].err = true;
								this.fields[key].errMsg = flags[key][0];
							}
						}
					});
    	}
    },

    created () {
    	// Get all artists for the selct list
    	axios.get('/booking-artists')
    		.then((response) => {
    			// Cache response
    			this.artists = response.data;
    		})
    		.catch((response) => {
    			console.log(response);
    		});
    }
	}
</script>

<style>
	.grey-border{
		border-color: #6f6f6f;
	}
	.mt-15{
		margin-top: 15px;
	}
	.mt-35{
		margin-top: 35px;
	}
	.form-group{
		margin-bottom: 25px;
	}
	.image-preview {
		height: 50px;
		width: 50px;
		border-radius: 50%;
		border-style: none;
	}
	.close-icon:hover{
		cursor: pointer;
	}
	#success-alert{
		position: fixed;
		z-index: 999;
		top: 35%;
		left: 0;
		width: 100%;
		padding: 35px 0 45px 0;
		background: #bc9355;
		color: #fff;
	}
	#success-alert icon{
		font-size: 45px;
		line-height: 75px;
	}
	.fade-enter-active, .fade-leave-active {
	  transition: opacity 1s
	}
	.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
	  opacity: 0
	}
</style>
