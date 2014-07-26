<?php namespace MPP\Repositories\User;

/**
 * Interface UserRepository
 * @package MPP\Repositories\User
 */
interface UserRepository
{
   /**
    * Display all users.
    *
    * @return mixed
    */
   public function all();

   /**
    * Display a single user by id.
    *
    * @param $id
    * @return mixed
    */
   public function find($id);

   public function create($input);

   public function update($data);


   public function destroy($id);

   /**
    * Store session.
    *
    * @return mixed
    */
   public function storeSession();

   /**
    * Destroy session.
    *
    * @return mixed
    */
   public function destroySession();

   /**
    * Store new user/register.
    *
    * @return mixed
    */
   public function storeRegister();
}