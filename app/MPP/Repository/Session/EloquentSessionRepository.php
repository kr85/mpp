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
   public function create($input)
   {
      $remember = (isset($input['remember'])) ? true : false;

      $credentials = array(
         'email' => $input['email'],
         'password' => $input['password']
      );

      $user = Sentry::authenticate($credentials, $remember);

      if (!$user) {
         return false;
      }

      return $user;
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