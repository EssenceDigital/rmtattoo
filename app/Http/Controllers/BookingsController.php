<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SaveWebsiteBooking;
use App\Http\Requests\SaveBooking;
use App\Booking;
use App\BookingImage;

class BookingsController extends Controller
{

	/**
	 * Get all bookings.
	 *
	 * @return JSON Response
	*/
	public function all()
	{
		return Booking::with(['user', 'images'])->orderBy('created_at', 'desc')->where('date_booked', '=', null)->get();
	}

  /**
   * Filters projects based on the recieved paramaters.
   *
   * @param String $status - Either 'requested' or 'confirmed'
   * @param String $artist - The artist id or '*' for all
   * @param String $from_date - The starting date
   * @param String $to_date - The ending date
   * @param JSON response
  */
  public function filter($status= false, $artist = false, $from_date = false, $to_date = false)
  {
    // Instatiate 'where array' for query
    $queryArray = [];
    // Start booking query
    $query = Booking::with(['user', 'images'])->orderBy('date_booked', 'asc');
    // Add booking status field to 'where array' or not
    if($status){
    	if($status === 'requested'){
	      // Push array clause
	      array_push($queryArray, ['date_booked', '=', null]);
    	} else if($status === 'confirmed'){
    		// Push array clause
      	array_push($queryArray, ['date_booked', '<>', null]);
    	}
    }
    // Add artist id to 'where array' or not
    if($artist){
    	// Only add the where clause if artist is not an asterisk
    	if($artist != '*'){
	    	// Push array clause
	    	array_push($queryArray, ['user_id', '=', $artist]);
    	}
    }
    // Add single day (from date) to the 'where array' field or not
    if($from_date && !$to_date){
      // Push array clause
      array_push($queryArray, ['date', '=', $from_date]);
    }
    // Add single day (to date) to the 'where array' field or not
    if($to_date && !$from_date){
      // Push array clause
      array_push($queryArray, ['date', '=', $to_date]);
    }
    // Add where queries
    $query->where($queryArray);
    // If the from and to date are set then it's a dange range query and the single day loop did not run. So...
    if($from_date && $to_date){
      // Add possible where between
      $query->whereBetween('date', [$from_date, $to_date]);
    }
    // Now find the bookings based on 'where array'
    $bookings = $query->get();

    // Return response for ajax call
    return $bookings;
  }

	/**
	 * Create a new booking
	 *
	 * @param  SaveArist $request
	 * @return JSON Response
	*/
	public function websiteCreate(SaveWebsiteBooking $request)
	{

    if(session('antibotanswer') != $request->captcha){
			// Return error is save didnt work
      return response()->json([
        'result' => 'error',
        'errors' => ['captcha' => ['Captcha answer is incorrect.']]
      ], 422);
    }

		// Start booking
		$booking = new Booking;
		// Fill booking
		$booking->fill($request->except(['images']));
		// Save booking
		if(! $booking->save()){
			// Return error is save didnt work
      return response()->json([
          'result' => 'error'
      ], 404);
		}

		// Next, If there is images present in the request
		if(count($request->images) > 0){
			// Itterate over each image
			forEach($request->images as $image){
				// Construct filename for image
				$filename = $request->first . ' ' . $request->last . ' ' . uniqid();
				// Store the image in the bookings folder and get the path to its location - with resize to 1650w
				$path = $this->storeImage($image, 'bookings', $filename, 1650);
				// Now we can create image entry and save to db
				$imageEntry = new BookingImage;
				// Populate
				$imageEntry->booking_id = $booking->id;
				$imageEntry->src = $path;
				// Save
				if(! $imageEntry->save()){
					// Return error is save didnt work
	        return response()->json([
	            'result' => 'images-error'
	        ], 404);
				}
			}
		}

		// Return success if everything worked
    return response()->json([
        'result' => 'success'
    ], 200);
	}

	/**
	 * Create a new booking
	 *
	 * @param  SaveBooking $request
	 * @return JSON Response
	*/
	public function create(SaveBooking $request)
	{
		// Start booking
		$booking = new Booking;
		// Fill booking
		$booking->fill($request->except(['images']));
		// Save booking
		if(! $booking->save()){
			// Return error is save didnt work
      return response()->json([
          'result' => 'error'
      ], 404);
		}
		// Load foreigns
		$booking->load('images', 'user');

		return $booking;
	}

	/**
	 * Update an existing booking
	 *
	 * @param  SaveBooking $request
	 * @return JSON Response
	*/
	public function update(SaveBooking $request)
	{
		// Start booking
		$booking = Booking::with(['user', 'images'])->find($request->id);
		// Fill booking
		$booking->fill($request->all())->update();

		return $booking;
	}

	public function addDate(Request $request)
	{
		// Validate first
		$data = $request->validate([
			'booking_id' => 'required|numeric',
			'date_booked' => 'required|date_format:Y-m-d H:i:s',
			'date' => 'required|date',
			'time' => 'required|max:8',
			'artist' => 'required|numeric'
		]);
		// Get the booking
		$booking = Booking::with(['user', 'images'])->find($data['booking_id']);
		// Add date / time
		$booking->date_booked = $data['date_booked'];
		$booking->date = $data['date'];
		$booking->time = $data['time'];
		$booking->user_id = $data['artist'];
		// Save booking
		if(! $booking->save()){
			// Return error is save didnt work
      return response()->json([
          'result' => 'error'
      ], 404);
		}
		// Update relationship
		$booking->load('user');

		return $booking;
	}

	/**
	 * Remove a booking
	 *
	 * @param  Integer $id - ID of the booking to remove
	 * @return JSON Response
	*/
  public function remove($id)
  {
  	// Ensure key is a number
  	if(is_numeric($id)){
  		// Find artist first because we need the avatar image path
  		$booking = Booking::with(['images'])->find($id);
  		// Cache images
  		$images = $booking->images->toArray();
  		// Remove Booking
  		if($booking->delete()){
  			// If there are images present...
  			if(count($images > 0)){
	  			// Remove each image
	  			forEach($images as $img){
		  			if(! unlink(storage_path() . '/app/public/' . $img['src'])){
			        // Return response for ajax call
			        return response()->json([
			            'result' => 'image-removal-error'
			        ], 404);
		  			}
	  			}
  			}
  			// We made it
  			return $id;
  		}
  	}
  }

}
