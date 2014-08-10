<?php namespace MPP\Repository\User;

use MPP\Repository\AbstractEloquentRepository;
use User;
use Sentry;

/**
 * Class EloquentUserRepository
 *
 * @package MPP\Repository\User
 */
class EloquentUserRepository extends AbstractEloquentRepository implements UserRepository
{
   /**
    * User model.
    *
    * @var User
    */
   protected $user;

   /**
    * Construct.
    *
    * @param User $user
    */
   public function __construct(User $user)
   {
      parent::__construct($user);
      $this->user = $user;
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
      $login = Sentry::authenticate($credentials, $remember);

      return $login;
   }

   /**
    * Destroy user's session.
    *
    * @return mixed|void
    */
   public function destroySession()
   {
      Sentry::logout();

   }

   /**
    * Register a new user.
    *
    * @param $info
    * @return \Cartalyst\Sentry\Users\UserInterface|mixed
    */
   public function storeRegister($info)
   {
      $user = Sentry::register($info, true);

      return $user;
   }
}