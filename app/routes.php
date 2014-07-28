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
   'before' => 'isGuest',
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

Route::get('register', array(
   'as'     => 'register.index',
   'before' => 'isGuest',
   'uses'   => 'RegisterController@create'
));

Route::post('register', array(
   'as'     => 'register.store',
   'before' => 'csrf|isGuest',
   'uses'   => 'RegisterController@store'
));

Route::get('ask', array(
   'as'     => 'qa.create',
   'before' => 'user',
   'uses'   => 'QuestionsController@create'
));

Route::post('ask', array(
   'as'     => 'qa.store',
   'before' => 'user|csrf',
   'uses'   => 'QuestionsController@store'
));

Route::get('qa', array(
   'as'     => 'qa.index',
   'before' => 'user',
   'uses'   => 'QuestionsController@index'
));

Route::get('question/{id}/{title}', array(
   'as' => 'qa.show',
   'uses' => 'QuestionsController@show'
))->where(array('id' => '[0-9]+', 'title' => '[0-9a-zA-Z\-\_]+'));

Route::get('question/vote/{direction}/{id}', array(
   'as'     => 'vote',
   'before' => 'user',
   'uses'   => 'QuestionsController@getVote'
))->where(array('direction' => '(up|down)', 'id' => '[0-9]+'));

Route::get('question/tagged/{tag}', array(
   'as'   => 'tagged',
   'uses' => 'QuestionsController@getTaggedWith'
))->where('tag', '[0-9a-zA-Z\-\_]+');

Route::get('question/delete/{id}', array(
   'as'     => 'question.delete',
   'before' => 'accessCheck:admin',
   'uses'   => 'QuestionsController@destroy'
))->where('id', '[0-9]+');

Route::post('question/{id}/{title}', array(
   'as'     => 'answer.post',
   'before' => 'csrf|user',
   'uses'   => 'AnswersController@post'
))->where(array('id' => '[0-9]+', 'title' => '[0-9a-zA-Z\-\_]+'));

Route::resource('epps', 'EppsController');