<?php namespace MPP\Repository\Session;

/**
 * Interface SessionRepository
 *
 * @package MPP\Repository\Session
 */
interface SessionRepository
{
   /**
    * Store user's session.
    *
    * @param $credentials
    * @param $remember
    * @return mixed
    */
   public function store($credentials, $remember);

   /**
    * Destroy a session.
    *
    * @return mixed
    */
   public function destroy();
}
