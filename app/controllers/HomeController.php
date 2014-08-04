<?php

/**
 * Class HomeController
 */
class HomeController extends BaseController
{
   /**
    * Master layout.
    *
    * @var string
    */
   protected $layout = 'layouts.master';

   /**
    * Gets main index.
    */
   public function getIndex()
   {
      $this->layout->content = View::make('index');
   }
}
