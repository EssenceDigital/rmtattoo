<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PortfolioImage;
use App\Faq;
use App\PortfolioArtist;

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
	    $portfolio = $portfolioCollection->toArray();

	    // Find FAQs
	    $faqs = Faq::all();

	  	return view('home')->withFaqs($faqs)->withPortfolio($portfolio);
    }

    public function portfolio()
    {
      // Find portfolio images
	    $portfolioCollection = PortfolioImage::all();
	    $portfolio = $portfolioCollection->toArray();

      $artists = PortfolioArtist::where('active', '=', true)->get();

      return view('pages.portfolio')->withArtists($artists)->withPortfolio($portfolio);
    }
}
