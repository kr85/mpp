<?php namespace MPP\Repository\User;

use MPP\Repository\Repository;
use User;

/**
 * Class EloquentUserRepository
 *
 * @package MPP\Repository\User
 */
class EloquentUserRepository implements Repository, UserRepository
{
   /**
    * User model.
    *
    * @var \User
    */
   protected $user;

   /**
    * Construct.
    *
    * @param User $user
    */
   public function __construct(User $user)
   {
      $this->user = $user;
   }

   /**
    * Get all users.
    *
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Builder|static
    */
   public function all(array $with = array())
   {
      $users = $this->user->with($with);

      return $users;
   }

   /**
    * Find a user by id.
    *
    * @param $id
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
    */
   public function find($id, array $with = array())
   {
      $user = $this->user->with($with)->find($id);

      return $user;
   }

   /**
    * Create a user.
    *
    * @param array $data
    * @return static
    */
   public function create(array $data)
   {
      return $this->user->create($data);
   }

   /**
    * Update a user.
    *
    * @param array $data
    * @return bool|int
    */
   public function update(array $data)
   {
      return $this->user->update($data);
   }

   /**
    * Delete a user.
    *
    * @param $id
    * @return bool|null
    */
   public function destroy($id)
   {
      $user = $this->find($id);

      if ($user)
      {
         return $user->delete();
      }
   }

   /**
    * Store user's session.
    *
    * @param $credentials
    * @param $remember
    * @return \Cartalyst\Sentry\Users\UserInterface|mixed
    */
   public function storeSession($credentials, $remember)
   {
      $login = \Sentry::authenticate($credentials, $remember);

      return $login;
   }

   /**
    * Destroy user's session.
    *
    * @return mixed|void
    */
   public function destroySession()
   {
      \Sentry::logout();

   }

   /**
    * Register a new user.
    *
    * @param $info
    * @return \Cartalyst\Sentry\Users\UserInterface|mixed
    */
   public function storeRegister($info)
   {
      $user = \Sentry::register($info, true);

      return $user;
   }
}