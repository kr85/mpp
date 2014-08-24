<?php namespace MPP\Form;

use Illuminate\Support\ServiceProvider;
use MPP\Form\Question\QuestionForm;
use MPP\Form\Question\QuestionFormValidator;
use MPP\Form\Register\RegisterForm;
use MPP\Form\Register\RegisterFormValidator;
use MPP\Form\Session\SessionForm;
use MPP\Form\Session\SessionFormValidator;

/**
 * Class FormServiceProvider
 *
 * @package MPP\Form
 */
class FormServiceProvider extends ServiceProvider
{
   /**
    * Register bindings.
    */
   public function register()
   {
      $this->registerSessionForm();
      $this->registerRegisterForm();
      $this->registerQuestionForm();
   }

   /**
    * Register session form.
    */
   protected function registerSessionForm()
   {
      $this->app->bind('MPP\Form\Session\SessionForm', function($app) {
         return new SessionForm(
            $app->make('MPP\Repository\Session\SessionRepository'),
            new SessionFormValidator($app['validator'])
         );
      });
   }

   /**
    * Register register form.
    */
   protected function registerRegisterForm()
   {
      $this->app->bind('MPP\Form\Register\RegisterForm', function($app) {
         return new RegisterForm(
            $app->make('MPP\Repository\Register\RegisterRepository'),
            new RegisterFormValidator($app['validator'])
         );
      });
   }

   /**
    * Register question form.
    */
   protected function registerQuestionForm()
   {
      $this->app->bind('MPP\Form\Question\QuestionForm', function($app) {
         return new QuestionForm(
            $app->make('MPP\Repository\Question\QuestionRepository'),
            new QuestionFormValidator($app['validator'])
         );
      });
   }
}
