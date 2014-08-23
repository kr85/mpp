<?php namespace MPP\Repository\Question;

use MPP\Repository\AbstractEloquentRepository;
use Question;

/**
 * Class EloquentQuestionRepository
 *
 * @package MPP\Repository\Question
 */
class EloquentQuestionRepository extends AbstractEloquentRepository implements QuestionRepository
{
   /**
    * Question model.
    *
    * @var \Question
    */
   protected $question;

   /**
    * Constructor.
    *
    * @param Question $question
    */
   public function __construct(Question $question)
   {
      parent::__construct($question);
      $this->question = $question;
   }

   /**
    * Get latest added questions.
    *
    * @param array $with
    * @param $orderByColumn
    * @param $orderByDirection
    * @param $number
    * @return mixed
    */
   public function getLatestQuestions(array $with, $orderByColumn, $orderByDirection, $number)
   {
      return $this->question->with($with)->orderBy($orderByColumn, $orderByDirection)->take($number)->get();
   }
}
