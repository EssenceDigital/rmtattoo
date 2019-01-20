<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@home');

Route::get('/precare-and-aftercare', function () {
		return view('pages.precare-aftercare');
});

Route::get('/portfolio', 'PagesController@portfolio');

Route::get('/app', 'AppController@index');

/*
 * Artist related routes
*/
Route::post('/portfolio-artists/create', 'PortfolioArtistsController@create');
Route::post('/portfolio-artists/update', 'PortfolioArtistsController@update');
Route::delete('/portfolio-artists/remove/{id}', 'PortfolioArtistsController@remove');
Route::get('/portfolio-artists', 'PortfolioArtistsController@all');

Route::post('/booking-artists/create', 'BookingArtistsController@create');
Route::post('/booking-artists/update', 'BookingArtistsController@update');
Route::delete('/booking-artists/remove/{id}', 'BookingArtistsController@remove');
Route::get('/booking-artists', 'BookingArtistsController@all');

/*
 * Portfolio related routes
*/
Route::post('/portfolio-images/create', 'PortfolioController@createImage');
Route::delete('/portfolio-images/remove/{id}', 'PortfolioController@remove');
Route::get('/portfolio-images', 'PortfolioController@allImages');

/*
 * Faqs related routes
*/
Route::post('/faqs/create', 'FaqsController@create');
Route::post('/faqs/update', 'FaqsController@update');
Route::delete('/faqs/remove/{id}', 'FaqsController@remove');
Route::get('/faqs', 'FaqsController@all');

/*
 * Booking related routes
*/
Route::post('/bookings/start', 'BookingsController@websiteCreate');

/*
 * Auth related routes
*/
Auth::routes();
Route::post('/users/create', 'UsersController@create');
Route::post('/users/update', 'UsersController@update');
Route::post('/users/change-password', 'UsersController@changePassword');
Route::get('/users/artists', 'UsersController@artists');
Route::delete('/users/remove/{id}', 'UsersController@remove');
Route::get('/users', 'UsersController@all');
