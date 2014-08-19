<?php namespace MPP\Validation\Session;

use MPP\Validation\AbstractValidator;

class SessionFormValidator extends AbstractValidator
{
   protected $rules = array(
      'email'                 => 'required|email|exists:users',
      'password'              => 'required|min:8'
   );

   protected $messages = array();
}