<?php namespace MPP\Repository\Register;

use Sentry;

/**
 * Class EloquentRegisterRepository
 *
 * @package MPP\Repository\Register
 */
class EloquentRegisterRepository implements RegisterRepository
{
   /**
    * Register a new user.
    *
    * @param $input
    * @return \Cartalyst\Sentry\Users\UserInterface|mixed
    */
   public function create($input)
   {
      $true = 1;
      $userGroupId = 2;

      $input = array(
         'username'     => $input['username'],
         'email'        => $input['email'],
         'password'     => $input['password'],
         'first_name'   => $input['first_name'],
         'last_name'    => $input['last_name'],
         'permissions'  => array('general-user' => $true),
         'activated_at' => new \DateTime()
      );

      $user = Sentry::register($input, true);
      $userGroup = Sentry::findGroupById($userGroupId);
      $user->addGroup($userGroup);

      if (!$user) {
         return false;
      }

      return true;
   }
}