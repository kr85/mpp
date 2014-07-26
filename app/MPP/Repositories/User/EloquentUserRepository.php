<?php namespace MPP\Repositories\User;

use User;

class EloquentUserRepository implements UserRepository
{
   protected $user;

   public function __construct(User $user)
   {
      $this->user = $user;
   }

   public function all()
   {
      return $this->user->all();
   }

   public function find($id)
   {
      return $this->user->find($id);
   }

   public function create($input)
   {
      return $this->user->create($input);
   }

   public function update($data)
   {
      //$user = $this->user->find($id);

      //$user->save(\Input::all());

      //return $user;
   }

   public function destroy($id)
   {
      $user = $this->user->find($id);

      if ($user)
      {
         $user->delete();
      }
   }

   public function storeSession()
   {
      $credentials = array(
         'email'    => \Input::get('email'),
         'password' => \Input::get('password')
      );

       $login = \Sentry::authenticate($credentials, false);

      return $login;
   }

   public function destroySession()
   {
      \Sentry::logout();

   }

   public function storeRegister()
   {
      $user = \Sentry::getUserProvider()->create(array(
         'username'     => \Input::get('username'),
         'email'        => \Input::get('email'),
         'password'     => \Input::get('password'),
         'first_name'   => \Input::get('first_name'),
         'last_name'    => \Input::get('last_name'),
         'permissions'  => array('general-user' => 1),
         'activated'    => 1,
         'activated_at' => new \DateTime()
      ));

      return $user;
   }
}