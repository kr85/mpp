<?php namespace MPP\Repositories;

use Illuminate\Support\ServiceProvider;
use MPP\Repositories\Question\EloquentQuestionRepository;
use MPP\Repositories\User\EloquentUserRepository;

/**
 * Class RepositoryServiceProvider
 *
 * @package MPP\Repositories
 */
class RepositoryServiceProvider extends ServiceProvider
{
   /**
    * Register repositories.
    */
   public function register()
   {
      $this->registerUserRepository();
      $this->registerQuestionRepository();
   }

   /**
    * Register user repository.
    */
   public function registerUserRepository()
   {
      $this->app->bind('MPP\Repositories\User\UserRepository', function($app) {
         return new EloquentUserRepository(new \User());
      });
   }

   /**
    * Register question repository.
    */
   public function registerQuestionRepository()
   {
      $this->app->bind('app\MPP\Repository\Question\QuestionRepository', function($app) {
         return new EloquentQuestionRepository(new \Question());
      });
   }
}