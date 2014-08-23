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
    * @param $credentials
    * @param $remember
    * @return \Cartalyst\Sentry\Users\UserInterface|mixed
    */
   public function store($credentials, $remember)
   {
      $login = Sentry::authenticate($credentials, $remember);

      return $login;
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