<?php namespace MPP\Validation\Register;

use MPP\Validation\AbstractValidator;

class RegisterFormValidator extends AbstractValidator
{
   protected $rules = array(
      'username'              => 'required|unique:users|between:4,16',
      'email'                 => 'required|email|unique:users',
      'password'              => 'required|min:8|confirmed',
      'password_confirmation' => 'required|min:8'
   );

   protected $messages = array();
}