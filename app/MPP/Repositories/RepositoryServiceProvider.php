<?php namespace MPP\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
   public function register()
   {
      $this->registerUserRepository();
   }

   public function registerUserRepository()
   {
      $this->app->bind(
         'MPP\Repositories\User\UserRepository',
         'MPP\Repositories\User\EloquentUserRepository'
      );
   }
}