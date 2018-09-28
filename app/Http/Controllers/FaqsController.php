<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SaveFaq;
use App\Faq;

class FaqsController extends Controller
{
	/**
	 * Get all faqs.
	 *
	 * @return JSON Response
	*/		
	public function all()
	{
		return Faq::orderBy('order', 'asc')->get();
	}

	/**
	 * Create a new faq
	 *
	 * @param  SaveFaq $request
	 * @return JSON Response
	*/	
	public function create(SaveFaq $request)
	{
        // For ACL, only allows supplied roles to access this method
        $this->authorizeRoles(['admin']);

		// Stat the faq
		$faq = new Faq;
		// Get all faqs so we can determine what order position this new faq should be
		$lastFaq = Faq::max('order');

		// If no last FAQ then it must be the first FAQ added
		if(! $lastFaq){
			$request->merge(['order' => 1]);
		} else{
			// Add the proper order to the faq
			$request->merge(['order' => $lastFaq + 1]);
		}

		return Faq::create($request->all());
	}    

	/**
	 * Updates an existing faq
	 *
	 * @param  SaveFaq $request
	 * @return JSON Response
	*/	
  public function update(SaveFaq $request)
  {
    // For ACL, only allows supplied roles to access this method
    $this->authorizeRoles(['admin']);  	

  	// Get Faq
  	$faq = Faq::find($request->id);
  	//
  	$changeOrder = false;
  	// Check if the order needs to be changed
  	if($faq->order != $request->order){
  		// Request order should be the new order for the FAQ, so find the FAQ that currently has that order
  		$changeOrder = Faq::where('order', '=', $request->order)->first();
  		// Update order
  		$changeOrder->order = $faq->order;
  		// Update the order
  		if(! $changeOrder->save()){
	        return response()->json([
	            'result' => 'error',
	            'msg' => 'Problem updating the order of the FAQs'
	        ], 200);   			
  		}
  		// Update the order on the requested faq
  		$request->merge(['order' => $request->order]);
  	}

  	// Update
  	$faq->fill($request->all())->update();

  	return ['first' => $faq, 'second' => $changeOrder];
  }

	/**
	 * Remove a faq
	 *
	 * @param  Integer $id - ID of the faq to remove
	 * @return JSON Response
	*/	
  public function remove($id)
  {
    // For ACL, only allows supplied roles to access this method
    $this->authorizeRoles(['admin']);
  	
  	// Ensure key is a number
  	if(is_numeric($id)){
  		// Remove artist
  		if(Faq::destroy($id)){
        // Return response for ajax call
        return response()->json([
            'result' => 'success',
            'payload' => $id
        ], 200);   			
  		}
  	}
  }

}
