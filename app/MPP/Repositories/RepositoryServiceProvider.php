<?php namespace MPP\Repositories;

use Illuminate\Support\ServiceProvider;
use MPP\Repositories\User\EloquentUserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
   public function register()
   {
      $this->registerUserRepository();
   }

   public function registerUserRepository()
   {
      $this->app->bind('MPP\Repositories\User\UserRepository', function($app) {
         return new EloquentUserRepository(new \User());
      });
   }
}