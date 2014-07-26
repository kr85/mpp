<?php

use MPP\Repositories\User\UserRepository;
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\UserNotActivatedException;
use Cartalyst\Sentry\Throttling\UserSuspendedException;
use Cartalyst\Sentry\Throttling\UserBannedException;

/**
 * Class SessionsController
 */
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
      $validation = \Validator::make(\Input::all(), $this->user->getSessionRules());

      if ($validation->fails()) {
         return \Redirect::route('sessions.login')
            ->withInput()
            ->withErrors($validation);
      } else {
         try {

            $login = $this->userRepository->storeSession();

            if ($login->getId() == null) {
               return Redirect::route('sessions.login');
            } else {
               return \Redirect::route('index')
                  ->with('success', 'You\'ve successfully logged in!');
            }
         } catch (LoginRequiredException $e) {
            return \Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'Login field is required.');
         } catch (PasswordRequiredException $e) {
            return \Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'Password field is required.');
         } catch (WrongPasswordException $e) {
            return \Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'Wrong password, try again.');
         } catch (UserNotFoundException $e) {
            return \Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'User was not found.');
         } catch (UserNotActivatedException $e) {
            return \Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'User is not activated.');
         } catch (UserSuspendedException $e) {
            return \Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'User is suspended.');
         } catch (UserBannedException $e) {
            return \Redirect::route('sessions.login')
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
		$this->userRepository->destroySession();

      return Redirect::route('sessions.logout')
         ->with('success', 'You\'ve successfully logged out!');
	}

}