<?php

use MPP\Repositories\User\UserRepository;

class RegisterController extends \BaseController
{
   protected $user;
   protected $userRepository;
   protected $layout = 'layouts.master';

   public function __construct(
      User $user,
      UserRepository $userRepository
   )
   {
      $this->user = $user;
      $this->userRepository = $userRepository;
   }


	public function create()
	{
		$this->layout->content = View::make('register.index');
	}

	public function store()
	{
		$validation = Validator::make(Input::all(), $this->user->getRegisterRules());

      if ($validation->fails()) {
         return Redirect::back()
            ->withInput()
            ->withErrors($validation);
      } else {
         $user = $this->userRepository->storeRegister();

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
}