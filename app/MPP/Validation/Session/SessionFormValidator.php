<?php namespace MPP\Validation\Session;

use MPP\Validation\LaravelValidator;
use MPP\Validation\ValidationInterface;

/**
 * Class SessionFormValidator
 *
 * @package MPP\Validation\Session
 */
class SessionFormValidator extends LaravelValidator implements ValidationInterface
{
   /**
    * Validation for creating a new session.
    *
    * @var array
    */
   protected $rules = array(
      'email'    => 'required|email|exists:users',
      'password' => 'required|min:8'
   );
}