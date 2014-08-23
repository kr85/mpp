<?php

use MPP\Repository\Register\RegisterRepository;
use MPP\Repository\Session\SessionRepository;
use MPP\Validation\Register\RegisterFormValidator;
use Cartalyst\Sentry\Sentry as Sentry;

/**
 * Class RegisterController
 */
class RegisterController extends \BaseController
{
   /**
    * Register repository.
    *
    * @var MPP\Repository\Register\RegisterRepository
    */
   protected $registerRepository;

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
    * Register form validation.
    *
    * @var
    */
   protected $validator;

   /**
    * Master layout.
    *
    * @var string
    */
   protected $layout = 'layouts.master';

   /**
    * Constructor.
    *
    * @param RegisterRepository $registerRepository
    * @param SessionRepository $sessionRepository
    * @param Sentry $sentry
    * @param RegisterFormValidator $registerFormValidator
    */
   public function __construct(
      RegisterRepository    $registerRepository,
      SessionRepository     $sessionRepository,
      Sentry                $sentry,
      RegisterFormValidator $registerFormValidator
   )
   {
      $this->registerRepository = $registerRepository;
      $this->sessionRepository = $sessionRepository;
      $this->sentry         = $sentry;
      $this->validator      = $registerFormValidator;
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
      $validation = $this->validator->with($input);

      if (!$validation->passes()) {
         return Redirect::back()
            ->withInput()
            ->withErrors($validation->errors());
      } else {
         $input = array(
            'username'     => \Input::get('username'),
            'email'        => \Input::get('email'),
            'password'     => \Input::get('password'),
            'first_name'   => \Input::get('first_name'),
            'last_name'    => \Input::get('last_name'),
            'permissions'  => array('general-user' => 1),
            'activated_at' => new \DateTime()
         );

         $user = $this->registerRepository->store($input);
         $userGroup = $this->sentry->findGroupById(2);
         $user->addGroup($userGroup);

         $this->welcomeEmail($input);

         $login = $this->sessionRepository->store(Input::only('email', 'password'), false);

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