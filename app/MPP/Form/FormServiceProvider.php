<?php namespace MPP\Form;

use Illuminate\Support\ServiceProvider;
use MPP\Form\Session\SessionForm;
use MPP\Form\Session\SessionFormValidator;

class FormServiceProvider extends ServiceProvider
{
   public function register()
   {
      $this->registerSessionForm();
   }

   protected function registerSessionForm()
   {
      $this->app->bind('MPP\Form\Session\SessionForm', function($app) {
         return new SessionForm(
            $app->make('MPP\Repository\Session\SessionRepository'),
            new SessionFormValidator($app['validator'])
         );
      });
   }
}
