<?php namespace MPP\Repository\User;

use MPP\Repository\Repository;

/**
 * Interface UserRepository
 * @package MPP\Repositories\User
 */
interface UserRepository extends Repository
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