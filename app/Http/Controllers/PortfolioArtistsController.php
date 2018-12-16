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

}
