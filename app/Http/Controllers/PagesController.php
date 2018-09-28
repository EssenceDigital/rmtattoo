<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PortfolioImage;
use App\Faq;

class PagesController extends Controller
{
    public function home()
    {
	    // Set up 'antibot' style 'captcha' for contact form
	    $numberConversion = array(
	        0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 
	        6 => 'six', 7 => 'seven', 8 =>'eight', 9 => 'nine', 10 => 'ten'
	    );
	    // Produce random numbers
	    $numberOne = rand( 0, 6 );
	    $numberTwo = rand( 0, 6 );
	    // Add to the session for usage later
	    session(['antibotquestion' => 'What is ' . $numberConversion[$numberOne] . 
	    					' added to ' . $numberConversion[$numberTwo] . ' *', 'antibotanswer' => $numberOne + $numberTwo]);


	    // Find portfolio images
	    $portfolioCollection = PortfolioImage::all();
	    // Break collection into chucnks of 4
	    $portfolioGroups = array_chunk($portfolioCollection->toArray(), 4);
	    // Break groups of 4 into groups of 3
	    $portfolio = array_chunk($portfolioGroups, 2);

	    // Find FAQs
	    $faqs = Faq::all();


	  	return view('home')->withPortfolio($portfolioCollection)->withFaqs($faqs);    	
    }
}
