<?php namespace MPP\Validation;

use Illuminate\Support\ServiceProvider;
use MPP\Validation\Answer\AnswerFormValidator;
use MPP\Validation\Question\QuestionFormValidator;
use MPP\Validation\Register\RegisterFormValidator;
use MPP\Validation\Session\SessionFormValidator;

/**
 * Class ValidationServiceProvider
 *
 * @package MPP\Validation
 */
class ValidationServiceProvider extends ServiceProvider
{
   /**
    * Register validators.
    */
   public function register()
   {
      $this->registerAskQuestionFormValidation();
      $this->registerAnswerQuestionFormValidation();
      $this->registerSessionFormValidation();
      $this->registerRegistrationFormValidation();
   }

   /**
    * Register ask question form validator.
    */
   protected function registerAskQuestionFormValidation()
   {
      $this->app->bind('MPP\Validation\Question\QuestionFormValidator', function($app) {
         return new QuestionFormValidator($app['validator']);
      });
   }

   /**
    * Register answer question form validator.
    */
   protected function registerAnswerQuestionFormValidation()
   {
      $this->app->bind('MPP\Validation\Answer\AnswerFormValidator', function($app) {
         return new AnswerFormValidator($app['validator']);
      });
   }

   /**
    * Register ask session form validator.
    */
   protected function registerSessionFormValidation()
   {
      $this->app->bind('MPP\Validation\Session\SessionFormValidator', function($app) {
         return new SessionFormValidator($app['validator']);
      });
   }

   /**
    * Register registration form validator.
    */
   protected function registerRegistrationFormValidation()
   {
      $this->app->bind('MPP\Validation\Register\RegisterFormValidator', function($app) {
         return new RegisterFormValidator($app['validator']);
      });
   }
}