<?php namespace MPP\Form\Register;

use MPP\Validation\LaravelValidator;
use MPP\Validation\ValidationInterface;

/**
 * Class RegisterFormValidator
 *
 * @package MPP\Validation\Register
 */
class RegisterFormValidator extends LaravelValidator implements ValidationInterface
{
   /**
    * Validation for registering a new user.
    *
    * @var array
    */
   protected $rules = array(
      'username'              => 'required|unique:users|between:4,16',
      'email'                 => 'required|email|unique:users',
      'password'              => 'required|min:8|confirmed',
      'password_confirmation' => 'required|min:8'
   );
}