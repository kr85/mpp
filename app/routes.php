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
   'as'     => 'question.create',
   'before' => 'user',
   'uses'   => 'QuestionsController@create'
));

Route::post('ask', array(
   'as'     => 'question.store',
   'before' => 'user|csrf',
   'uses'   => 'QuestionsController@store'
));

Route::get('qa', array(
   'as'     => 'question.index',
   'before' => 'user',
   'uses'   => 'QuestionsController@index'
));

Route::get('question/{id}/{title}', array(
   'as' => 'question.show',
   'uses' => 'QuestionsController@show'
))->where(array('id' => '[0-9]+', 'title' => '[0-9a-zA-Z\-\_]+'));

Route::get('question/edit/{id}', array(
   'as'     => 'question.edit',
   'before' => 'user',
   'uses'   => 'QuestionsController@edit'
))->where('id', '[0-9]+');

Route::patch('question/update/{id}', array(
   'as'     => 'question.update',
   'before' => 'user|csrf',
   'uses'   => 'QuestionsController@update'
))->where('id', '[0-9]+');

Route::get('question/tagged/{tag}', array(
   'as'   => 'tagged',
   'uses' => 'QuestionsController@getTaggedWith'
))->where('tag', '[0-9a-zA-Z\-\_]+');

Route::get('question/delete/{id}', array(
   'as'     => 'question.delete',
   'before' => 'user',
   'uses'   => 'QuestionsController@destroy'
))->where('id', '[0-9]+');

Route::get('question/lock/{id}', array(
   'as'     => 'question.lock',
   'before' => 'accessCheck:admin',
   'uses'   => 'QuestionsController@lock'
))->where('id', '[0-9]+');

Route::get('question/unlock/{id}', array(
   'as'     => 'question.unlock',
   'before' => 'accessCheck:admin',
   'uses'   => 'QuestionsController@unlock'
))->where('id', '[0-9]+');

Route::post('question/{id}/{title}', array(
   'as'     => 'answer.store',
   'before' => 'csrf|user',
   'uses'   => 'AnswersController@store'
))->where(array('id' => '[0-9]+', 'title' => '[0-9a-zA-Z\-\_]+'));

Route::get('answer/vote/{direction}/{id}', array(
   'as'     => 'answer.vote',
   'before' => 'user',
   'uses'   => 'AnswersController@getVote'
))->where(array('direction' => '(up|down)', 'id' => '[0-9+]'));

Route::get('answer/choose/{id}', array(
   'as'     => 'choose.best.answer',
   'before' => 'user',
   'uses'   => 'AnswersController@getChooseBestAnswer'
))->where('id', '[0-9]+');

Route::get('answer/delete/{id}', array(
   'as'     => 'answer.delete',
   'before' => 'user',
   'uses'   => 'AnswersController@destroy'
))->where('id', '[0-9]+');

Route::resource('epps', 'EppsController');