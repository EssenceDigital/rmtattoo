<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SaveArtist;
use App\PortfolioArtist;

class PortfolioArtistsController extends Controller
{
  /**
	 * Get all artists
	 *
	 * @return JSON Response
	*/
	public function all()
	{
		return PortfolioArtist::orderBy('created_at', 'desc')->get();
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
		$artist = new PortfolioArtist;
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
	public function update(SaveBooking $request)
	{
		// Find artist
		$artist = PortfolioArtist::findOrFail($request->id);
    // Fill artist
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
  		$artist = PortfolioArtist::with(['images'])->find($id);
  		// Cache images
  		$images = $artist->images->toArray();
  		// Remove Booking
  		if($artist->delete()){
  			// If there are images present...
  			//if(count($images > 0)){
	  			// Remove each image
	  			forEach($images as $img){
		  			if(! unlink(storage_path() . '/app/public/' . $img['src'])){
			        // Return response for ajax call
			        return response()->json([
			            'result' => 'image-removal-error'
			        ], 404);
		  			}
	  			}
  			//}
  			// We made it, for ease of use, pass back the remaining artist
  			return PortfolioArtist::orderBy('created_at', 'desc')->get();
  		}
  	}
  }

}
