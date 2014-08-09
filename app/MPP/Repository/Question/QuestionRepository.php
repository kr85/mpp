<?php namespace MPP\Repository\Question;

/**
 * Interface QuestionRepository
 *
 * @package MPP\Repository\Question
 */
interface QuestionRepository
{
   /**
    * Get latest added questions.
    *
    * @param array $with
    * @param $orderByColumn
    * @param $orderByDirection
    * @param $number
    * @return mixed
    */
   public function getLatestQuestions(array $with, $orderByColumn, $orderByDirection, $number);
}
