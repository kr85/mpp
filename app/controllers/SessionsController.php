<?php

use MPP\Repositories\User\UserRepository;

class SessionsController extends \BaseController
{
   /**
    * User model.
    *
    * @var User
    */
   protected $user;

   /**
    * User repository.
    *
    * @var MPP\Repositories\User\UserRepository
    */
   protected $userRepository;

   /**
    * Master layout.
    *
    * @var string
    */
   protected $layout = 'layouts.master';

   /**
    * Construct.
    *
    * @param User $user
    * @param UserRepository $userRepository
    */
   public function __construct(
      User $user,
      UserRepository $userRepository
   )
   {
      $this->user = $user;
      $this->userRepository = $userRepository;
   }

   /**
    * Renders the sessions login page.
    */
   public function create()
	{
      $this->layout->content = View::make('sessions.login');
	}

   /**
    * Stores the new session.
    *
    * @return \Illuminate\Http\RedirectResponse
    */
   public function store()
	{
		$validation = Validator::make(Input::all(), $this->user->getSessionRules());

      if ($validation->fails()) {
         return Redirect::route('sessions.login')
            ->withInput()
            ->withErrors($validation);
      } else {
         try {
            $credentials = array(
               'email'    => Input::get('email'),
               'password' => Input::get('password')
            );

            Sentry::authenticate($credentials, false);

            return Redirect::route('index')
               ->with('success', 'You\'ve successfully logged in!');

         } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'Login field is required.');
         } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'Password field is required.');
         } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'Wrong password, try again.');
         } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'User was not found.');
         } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'User is not activated.');
         } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'User is suspended.');
         } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'User is banned.');
         }
      }
	}

   /**
    * Destroys the current session.
    *
    * @return \Illuminate\Http\RedirectResponse
    */
   public function destroy()
	{
		Sentry::logout();

      return Redirect::route('sessions.logout')
         ->with('success', 'You\'ve successfully logged out!');
	}

}