<?php namespace MPP\Repository;

use Illuminate\Support\ServiceProvider;
use MPP\Cache\LaravelCache;
use MPP\Repository\Answer\EloquentAnswerRepository;
use MPP\Repository\Question\CacheDecorator;
use MPP\Repository\Question\EloquentQuestionRepository;
use MPP\Repository\User\EloquentUserRepository;

/**
 * Class RepositoryServiceProvider
 *
 * @package MPP\Repository
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
      $this->registerAnswerRepository();
   }

   /**
    * Register user repository.
    */
   public function registerUserRepository()
   {
      $this->app->bind('MPP\Repository\User\UserRepository', function($app) {
         return new EloquentUserRepository(new \User());
      });
   }

   /**
    * Register question repository.
    */
   public function registerQuestionRepository()
   {
      $this->app->bind('MPP\Repository\Question\QuestionRepository', function($app) {
         $questionRepository =  new EloquentQuestionRepository(new \Question());

         /*return new CacheDecorator(
            $questionRepository,
            new LaravelCache($app['cache'], 'question')
         );*/
         return $questionRepository;
      });
   }

   /**
    * Register answer repository.
    */
   public function registerAnswerRepository()
   {
      $this->app->bind('MPP\Repository\Answer\AnswerRepository', function($app) {
         return new EloquentAnswerRepository(new \Answer());
      });
   }
}