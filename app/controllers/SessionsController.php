<?php

use MPP\Repository\Session\SessionRepository;
use MPP\Form\Session\SessionForm;
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
    * Session repository.
    *
    * @var MPP\Repository\Session\SessionRepository
    */
   protected $sessionRepository;

   /**
    * Master layout.
    *
    * @var string
    */
   protected $layout = 'layouts.master';

   /**
    * Session form.
    *
    * @var MPP\Form\Session\SessionForm
    */
   protected $sessionForm;

   /**
    * Constructor.
    *
    * @param SessionRepository $sessionRepository
    * @param SessionForm $sessionForm
    */
   public function __construct(
      SessionRepository $sessionRepository,
      SessionForm       $sessionForm
   )
   {
      $this->sessionRepository = $sessionRepository;
      $this->sessionForm       = $sessionForm;
   }

   /**
    * Renders the sessions login page.
    */
   public function create()
	{
      return $this->layout->content = View::make('sessions.login');
	}

   /**
    * Stores the new session.
    *
    * @return \Illuminate\Http\RedirectResponse
    */
   public function store()
	{
      $input = Input::all();
      $sessionForm = $this->sessionForm->save($input);

      if (!$sessionForm) {
         return Redirect::route('sessions.login')
            ->withInput()
            ->withErrors($this->sessionForm->errors());
      } else {
         try {
            return Redirect::intended('/')
               ->with('success', 'You\'ve successfully logged in!');
         } catch (LoginRequiredException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'Login field is required.');
         } catch (PasswordRequiredException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'Password field is required.');
         } catch (WrongPasswordException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'Wrong password, try again.');
         } catch (UserNotFoundException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'User was not found.');
         } catch (UserNotActivatedException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'User is not activated.');
         } catch (UserSuspendedException $e) {
            return Redirect::route('sessions.login')
               ->withInput()
               ->with('error', 'User is suspended.');
         } catch (UserBannedException $e) {
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
		$this->sessionRepository->destroy();

      return Redirect::route('index')
         ->with('success', 'You\'ve successfully logged out!');
	}
}