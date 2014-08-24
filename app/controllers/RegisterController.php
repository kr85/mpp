<?php

use MPP\Repository\Session\SessionRepository;
use MPP\Form\Register\RegisterForm;
use Cartalyst\Sentry\Sentry as Sentry;

/**
 * Class RegisterController
 */
class RegisterController extends \BaseController
{
   /**
    * Session repository.
    *
    * @var MPP\Repository\Session\SessionRepository
    */
   protected $sessionRepository;

   /**
    * Sentry model.
    *
    * @var Sentry
    */
   protected $sentry;

   /**
    * Register form.
    *
    * @var MPP\Form\Register\RegisterForm
    */
   protected $registerForm;

   /**
    * Master layout.
    *
    * @var string
    */
   protected $layout = 'layouts.master';

   /**
    * Constructor.
    *
    * @param SessionRepository $sessionRepository
    * @param Sentry $sentry
    * @param RegisterForm $registerForm
    */
   public function __construct(
      SessionRepository $sessionRepository,
      Sentry            $sentry,
      RegisterForm      $registerForm
   )
   {
      $this->sessionRepository = $sessionRepository;
      $this->sentry            = $sentry;
      $this->registerForm      = $registerForm;
   }

   /**
    * Displays the registration page.
    */
   public function create()
	{
		return $this->layout->content = View::make('register.index');
	}

   /**
    * Stores a new user to the database.
    *
    * @return \Illuminate\Http\RedirectResponse
    */
   public function store()
	{
      $input = Input::all();
      $registerForm = $this->registerForm->save($input);

      if (!$registerForm) {
         return Redirect::back()
            ->withInput()
            ->withErrors($this->registerForm->errors());
      } else {
         $this->welcomeEmail($input);
         $login = $this->sessionRepository->create(Input::only('email', 'password'), false);

         if ($login->getId() != null) {
            return Redirect::route('index')
               ->with('success', 'You\'ve registered and logged in successfully!');
         } else {
            return Redirect::back()
               ->withInput()
               ->with('error', 'Registration was unsuccessful!');
         }
      }
	}

   /**
    * Sends a welcome email to newly registered users.
    *
    * @param $data
    */
   public function  welcomeEmail($data)
   {
      Mail::send('emails.welcome', $data, function($message) {
         $message->to(Input::get('email'), Input::get('first_name') . ' ' . Input::get('last_name'));
         $message->subject('Welcome to MPP!');
      });
   }
}