<?php

use MPP\Repositories\User\UserRepository;
use Cartalyst\Sentry\Sentry as Sentry;

/**
 * Class RegisterController
 */
class RegisterController extends \BaseController
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
    * Sentry model.
    *
    * @var Sentry
    */
   protected $sentry;

   /**
    * Master layout.
    *
    * @var string
    */
   protected $layout = 'layouts.master';

   public function __construct(
      User $user                     = null,
      UserRepository $userRepository = null,
      Sentry $sentry                 = null
   )
   {
      $this->user           = $user;
      $this->userRepository = $userRepository;
      $this->sentry         = $sentry;
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
		$validation = Validator::make($data = Input::all(), $this->user->getRegisterRules());

      if ($validation->fails()) {
         return Redirect::back()
            ->withInput()
            ->withErrors($validation);
      } else {
         $user = $this->userRepository->storeRegister();
         $userGroup = $this->sentry->findGroupById(2);
         $user->addGroup($userGroup);

         $this->welcomeEmail($data);

         $login = $this->userRepository->storeSession();

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