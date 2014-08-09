<?php namespace MPP\Composer;

use Illuminate\Support\ServiceProvider;

/**
 * Class ComposerServiceProvider
 *
 * @package MPP\Composer
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
      $this->app->view->composer('menus.qa.sidebar', 'MPP\Composer\QuestionsListComposer');
   }

   /**
    * Register answers list composer.
    */
   public function registerAnswersListComposer()
   {
      $this->app->view->composer('menus.qa.sidebar', 'MPP\Composer\AnswersListComposer');
   }

   /**
    * Bootstrap application events.
    */
   public function boot()
   {
      //$this->app->view->composer('menus.qa.sidebar', $this->app->make('MPP\Composer\QuestionsListComposer'));
      //$this->app->view->composer('menus.qa.sidebar', $this->app->make('MPP\Composer\AnswersListComposer'));
   }
}
