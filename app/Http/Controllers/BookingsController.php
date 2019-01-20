<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SaveWebsiteBooking;
use App\Http\Requests\SaveBooking;
use App\Booking;
use App\BookingImage;
use App\Mail\SendBooking;
use Mail;

class BookingsController extends Controller
{
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

		// If there is images present in the request
		$images = [];
		if(count($request->images) > 0){
				foreach($request->images as $img){
					// Get mime type from base64 string (could be incorrect)
					$pos  = strpos($img, ';');
					$type = explode(':', substr($img, 0, $pos))[1];
					// Store the image in the bookings folder and get the path to its location - with resize to 1650w
					$path = $this->storeImage($img, 'bookings', uniqid(), 1150);
					// Push image to array with mime type
					array_push($images, url('storage/'.$path));
				}
		}

		// Send booking request
		Mail::to(env('CONTACT_EMAIL'))->send(new SendBooking(
				[
						'from' => $request->email,
						'name' => $request->first . ' ' . $request->last,
						'phone' => $request->phone,
						'artist' => $request->artist,
						'tattoo_size' => $request->tattoo_size,
						'description' => $request->description,
						'location' => $request->location,
						'color_preference' => $request->color_preference,
						'tattoo_style' => $request->tattoo_style,
						'budget' => $request->budget,
						'images' => $images
				]
		));

		// Return success if everything worked
    return response()->json([
        'result' => 'success'
    ], 200);
	}

}
