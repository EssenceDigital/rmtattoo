<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use Intervention\Image\ImageManagerStatic as Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function storeImage($base64Image, $subfolder, $filename, $resizeWidth = false)
    {
    	// Explode base64 image
    	$exploded = explode(',', $base64Image);
    	// Decode the base64 image section
    	$image = base64_decode($exploded[1]);
    	// Get the image extension
    	$extension = $this->getBetween($exploded[0], '/', ';');
    	// Create image file name
    	$imageName = preg_replace("/[\s_]/", "-", $filename);
    	// Construct image path WITHOUT storage path (for db)
    	$path = $subfolder . '/' . $imageName . '.' . $extension;
    	// Store image adding in storage path
    	file_put_contents(storage_path() . '/app/public/' . $path, $image);
    	// Resize the image if required
    	if($resizeWidth){
    		$this->resizeImage(storage_path() . '/app/public/' . $path, $resizeWidth);
    	}

    	return $path;
    }

    protected function resizeImage($imagePath, $width)
    {
    	// Get the image
    	$image = Image::make($imagePath);
    	// Resize, keeping aspect ratio
			$image->resize($width, null, function ($constraint) {
				$constraint->aspectRatio();
			});

			return $image->save($imagePath);  	
    }

		protected function getBetween($content, $start, $end)
    {
        $r = explode($start, $content);
        if(isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
	}    

    /* ****************************************************
     * For User access control.
     * ****************************************************
    */

    /** 
     * Top level check. Ensures the user has the required role to access calling resource
     *
     * @param Array or String - The allowed roles
     * @return boolean
    */
    public function authorizeRoles($roles)
    {
        // Check if the supplied roles exist in role set
        if($this->hasAnyRole($roles)) {
            return true;
        } 
        // Not authorized
        else {
            return response()->json([
                'result' => 'false',
                'error' => 'true',
                'message' => "Not authorized."
            ], 401)->send(); // MUST send() to return full response
        }         
    }

    /** 
     * Checks all supplied roles to determine if they are allowed access
     *
     * @param Array or String - The allowed roles
     * @return Boolean
    */
    public function hasAnyRole($roles)
    {
        // If supplied roles is an array
        if(is_array($roles)) {
            // Itterate through supplied roles
            foreach($roles as $role) {
                // Check if the users permissions matches the supplied role or not
                if(auth()->user()->role === $role) {
                    // If matched...
                    return true;
                }
            }
        } 
        // Return false for all other conditions
        return false;
    }    
}
