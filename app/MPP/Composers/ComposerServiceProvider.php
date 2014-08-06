<?php namespace MPP\Composers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ComposerServiceProvider
 *
 * @package MPP\Composers
 */
class ComposerServiceProvider extends ServiceProvider
{
   /**
    * Register composers.
    */
   public function register()
   {
      $this->registerQuestionsListComposer();
      $this->registerAnswersListComposer();
   }

   /**
    * Register questions list composer.
    */
   public function registerQuestionsListComposer()
   {
      $this->app->view->composer('menus.qa.sidebar', 'MPP\Composers\QuestionsListComposer');
      /*$this->app->bind('MPP\Composers\QuestionsListComposer', function($app) {
         new QuestionsListComposer($this->app->make('MPP\Repositories\Question\QuestionRepository'));
      });*/
   }

   /**
    * Register answers list composer.
    */
   public function registerAnswersListComposer()
   {
      $this->app->view->composer('menus.qa.sidebar', 'MPP\Composers\AnswersListComposer');
   }

   /**
    * Bootstrap application events.
    */
   public function boot()
   {
      //$this->app->view->composer(array('menus.qa.sidebar'), $this->app->make('MPP\Composers\QuestionsListComposer'));
   }
}
