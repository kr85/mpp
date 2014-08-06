<?php namespace MPP\Composers;

use MPP\Repositories\Question\QuestionRepository;

/**
 * Class QuestionsListComposer
 *
 * @package MPP\Composers
 */
class QuestionsListComposer
{
   //protected $questionRepository;

   /*public function __construct(QuestionRepository $questionRepository)
   {
      $this->questionRepository = $questionRepository;
   }*/

   /**
    * Compose.
    *
    * @param $view
    */
   public function compose($view)
   {
      $recentQuestions = \Question::with('users', 'answers', 'tags')->take(10)->orderBy('id', 'desc')->get();
      $view->with('recentQuestions', $recentQuestions);
   }
}