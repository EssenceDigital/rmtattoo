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

Route::get('/app', 'AppController@index');

/*
 * Artist related routes
*/
Route::post('/artists/create', 'ArtistsController@create');
Route::post('/artists/update', 'ArtistsController@update');
Route::delete('/artists/remove/{id}', 'ArtistsController@remove');
Route::get('/artists', 'ArtistsController@all');

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
Route::post('/bookings/create', 'BookingsController@create');
Route::post('/bookings/update', 'BookingsController@update');
Route::post('/bookings/add-date', 'BookingsController@addDate');
Route::delete('/bookings/remove/{id}', 'BookingsController@remove');
Route::get('/bookings', 'BookingsController@all');
Route::get('/bookings/{status}/{artist}/{from_date}/{to_date}', 'BookingsController@filter');

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
