<?php namespace MPP\Repository\User;

/**
 * Interface UserRepository
 * @package MPP\Repositories\User
 */
interface UserRepository
{
   /**
    * Store user's session.
    *
    * @param $credentials
    * @param $remember
    * @return mixed
    */
   public function storeSession($credentials, $remember);

   /**
    * Destroy a session.
    *
    * @return mixed
    */
   public function destroySession();

   /**
    * Register,
    *
    * @param $info
    * @return mixed
    */
   public function storeRegister($info);
}