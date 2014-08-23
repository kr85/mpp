<?php namespace MPP\Repository\Session;

use Sentry;

/**
 * Class EloquentSessionRepository
 *
 * @package MPP\Repository\Session
 */
class EloquentSessionRepository implements SessionRepository
{
   /**
    * Store user's session.
    *
    * @param $input
    * @return \Cartalyst\Sentry\Users\UserInterface|mixed
    */
   public function store($input)
   {
      //$remember = (\Input::has('remember')) ? true : false;
      $remember = false;

      $credentials = array(
         'email' => $input['email'],
         'password' => $input['password']
      );

      $login = Sentry::authenticate($credentials, $remember);

      if (!$login) {
         return false;
      }

      return true;
   }

   /**
    * Destroy user's session.
    *
    * @return mixed|void
    */
   public function destroy()
   {
      Sentry::logout();
   }
}