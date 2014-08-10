<?php namespace MPP\Repository\Answer;

use MPP\Repository\AbstractEloquentRepository;
use Answer;

/**
 * Class EloquentAnswerRepository
 *
 * @package MPP\Repository\Answer
 */
class EloquentAnswerRepository extends AbstractEloquentRepository implements AnswerRepository
{
   /**
    * Answer model.
    *
    * @var Answer
    */
   protected $answer;

   public function __construct(Answer $answer)
   {
      parent::__construct($answer);
      $this->answer = $answer;
   }

   /**
    * Get the latest answers.
    *
    * @param array $with
    * @param $orderByColumn
    * @param $orderByDirection
    * @param $number
    * @return mixed
    */
   public function getLatestAnswers(array $with, $orderByColumn, $orderByDirection, $number)
   {
      return $this->answer->with($with)->orderBy($orderByColumn, $orderByDirection)->take($number)->get();
   }
}
