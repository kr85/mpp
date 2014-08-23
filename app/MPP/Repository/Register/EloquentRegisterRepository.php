<?php namespace MPP\Repository\Register;

use Sentry;

/**
 * Class EloquentRegisterRepository
 *
 * @package MPP\Repository\Register
 */
class EloquentRegisterRepository implements RegisterRepository
{
   /**
    * Register a new user.
    *
    * @param $input
    * @return \Cartalyst\Sentry\Users\UserInterface|mixed
    */
   public function store($input)
   {
      $user = Sentry::register($input, true);

      return $user;
   }
}