<?php namespace MPP\Composers;

/**
 * Class AnswersListComposer
 *
 * @package MPP\Composers
 */
class AnswersListComposer
{
   /**
    * Compose.
    *
    * @param $view
    */
   public function compose($view)
   {
      $recentAnswers = \Answer::with('questions')->take(10)->orderBy('id', 'desc')->get();
      $view->with('recentAnswers', $recentAnswers);
   }
}