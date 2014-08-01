<?php namespace MPP\Repositories;

use Illuminate\Support\ServiceProvider;
use MPP\Repositories\Question\EloquentQuestionRepository;
use MPP\Repositories\User\EloquentUserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
   public function register()
   {
      $this->registerUserRepository();
      $this->registerQuestionRepository();
   }

   public function registerUserRepository()
   {
      $this->app->bind('MPP\Repositories\User\UserRepository', function($app) {
         return new EloquentUserRepository(new \User());
      });
   }

   public function registerQuestionRepository()
   {
      $this->app->bind('MPP\Repository\Question\QuestionRepository', function($app) {
         return new EloquentQuestionRepository(new \Question());
      });
   }
}