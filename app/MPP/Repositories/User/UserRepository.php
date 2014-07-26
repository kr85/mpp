<?php namespace MPP\Repositories\User;

interface UserRepository
{
   public function all();

   public function find($id);

   public function create($input);

   public function update($data);

   public function destroy($id);
}