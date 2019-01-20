<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SavePortfolioImage;

use App\PortfolioImage;

class PortfolioController extends Controller
{

	/**
	 * Get all portfolio images
	 *
	 * @return JSON Response
	*/
	public function allImages()
	{
		return PortfolioImage::all();
	}

	/**
	 * Create a new image in portfolio
	 *
	 * @param  SavePortfolioImage $request
	 * @return JSON Response
	*/
	public function createImage(SavePortfolioImage $request)
	{
        // For ACL, only allows supplied roles to access this method
        $this->authorizeRoles(['admin']);

		// Store the image in the portfolio folder and get the path to its location - with resize to 1050w
		$path = $this->storeImage($request->src, 'portfolio', uniqid(), 1050);
		// Update the request to hold the path to the stored image and not the base64 image
		$request->merge(['src' => $path]);

		return PortfolioImage::create($request->all());
	}

		/**
		 * Remove an image
		 *
		 * @param  Integer $id - ID of the image to remove
		 * @return JSON Response
		*/
    public function remove($id)
    {
        // For ACL, only allows supplied roles to access this method
        $this->authorizeRoles(['admin']);

    	// Ensure key is a number
    	if(is_numeric($id)){
    		// Find image first
    		$image = PortfolioImage::find($id);
    		// Save image path
    		$path = $image->src;
    		// Remove image
    		if($image->delete()){
    			// Remove image
    			if(unlink(storage_path() . '/app/public/' . $path)){
		        // Return response for ajax call
		        return response()->json([
		            'result' => 'success',
		            'payload' => $id
		        ], 200);
    			}
    		}
    	}
    }
}
