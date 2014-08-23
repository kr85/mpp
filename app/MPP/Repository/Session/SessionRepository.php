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
    * @return mixed
    */
   public function store($credentials);

   /**
    * Destroy a session.
    *
    * @return mixed
    */
   public function destroy();
}
