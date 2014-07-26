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

Route::get('/', array(
   'as'   => 'index',
   'uses' => 'HomeController@getIndex'
));

Route::get('login', array(
   'as'     => 'sessions.login',
   'before' => 'is_guest',
   'uses'   => 'SessionsController@create'
));

Route::post('login', array(
   'as'     => 'sessions.store',
   'before' => 'csrf|isGuest',
   'uses'   => 'SessionsController@store'
));

Route::get('logout', array(
   'as'     => 'sessions.logout',
   'before' => 'user',
   'uses'   => 'SessionsController@destroy'
));
