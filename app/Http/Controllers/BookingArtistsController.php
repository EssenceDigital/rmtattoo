<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SaveArtist;
use App\BookingArtist;

class BookingArtistsController extends Controller
{
  /**
	 * Get all artists
	 *
	 * @return JSON Response
	*/
	public function all()
	{
		return BookingArtist::orderBy('created_at', 'desc')->get();
	}

  /**
	 * Create a new artist
	 *
	 * @param  SaveArtist $request
	 * @return JSON Response
	*/
	public function create(SaveArtist $request)
	{
		// Start booking
		$artist = new BookingArtist;
		// Fill booking
		$artist->fill($request->all());
		// Save booking
		if(! $artist->save()){
			// Return error is save didnt work
      return response()->json([
          'result' => 'error'
      ], 404);
		}

		return $artist;
	}

  /**
	 * Update an existing artist
	 *
	 * @param  SaveArtist $request
	 * @return JSON Response
	*/
	public function update(SaveArtist $request)
	{
		// Find artist
		$artist = BookingArtist::findOrFail($request->id);
    // Fill artist
		$artist->fill($request->all());
		// Save booking
		if(! $artist->save()){
			// Return error is save didnt work
      return response()->json([
          'result' => 'error'
      ], 404);
		}

		return BookingArtist::orderBy('created_at', 'desc')->get();
	}

	/**
	 * Remove an artist and all associated images
	 *
	 * @param  Integer $id - ID of the booking to remove
	 * @return JSON Response
	*/
  public function remove($id)
  {
		// For ACL, only allows supplied roles to access this method
		$this->authorizeRoles(['admin']);

  	// Ensure key is a number
  	if(is_numeric($id)){
  		// Find artist first because we need the avatar image path
  		$artist = BookingArtist::find($id);

  		// Remove Booking
  		if($artist->delete()){
  			// We made it, for ease of use, pass back the remaining artist
  			return BookingArtist::orderBy('created_at', 'desc')->get();
  		}
  	}
  }

}
