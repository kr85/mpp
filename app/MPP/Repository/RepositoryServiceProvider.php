<?php namespace MPP\Repository;

use Illuminate\Support\ServiceProvider;
use MPP\Cache\LaravelCache;
use MPP\Repository\Answer\AnswerCacheDecorator;
use MPP\Repository\Answer\EloquentAnswerRepository;
use MPP\Repository\Question\QuestionCacheDecorator;
use MPP\Repository\Question\EloquentQuestionRepository;
use MPP\Repository\User\EloquentUserRepository;
use User;
use Question;
use Answer;

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
         return new EloquentUserRepository(new User());
      });
   }

   /**
    * Register question repository.
    */
   public function registerQuestionRepository()
   {
      $this->app->bind('MPP\Repository\Question\QuestionRepository', function($app) {
         $questionRepository =  new EloquentQuestionRepository(new Question());

         /*return new QuestionCacheDecorator(
            $questionRepository,
            new LaravelCache($app['cache'], 'question'),
            new Question()
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
         $answerRepository = new EloquentAnswerRepository(new Answer());

         /*return new AnswerCacheDecorator(
            $answerRepository,
            new LaravelCache($app['cache'], 'answer'),
            new Answer()
         );*/
         return $answerRepository;
      });
   }
}