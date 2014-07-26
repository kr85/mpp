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

}