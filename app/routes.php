<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//routes for guest users
Route::group(array('before'=>'guest'),function(){

  Route::get('/', function()
	{
		return View::make('index');
	});

	Route::get('/angular', function()
	{
		return View::make('hello');
	});

	Route::post('app/register','HomeController@RegisterUser');

	Route::post('app/login','HomeController@loginuser');


	});

//all login user routes
Route::group(array('before'=>'auth'),function(){
    
    Route::get('dashboard','HomeController@dashboard');
    Route::get('logout','HomeController@logoutuser');

});


