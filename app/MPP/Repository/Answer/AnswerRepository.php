<?php namespace MPP\Repository\Answer;

use MPP\Repository\Crudable;
use MPP\Repository\Repository;

/**
 * Interface AnswerRepository
 *
 * @package MPP\Repository\Answer
 */
interface AnswerRepository extends Repository, Crudable
{
   /**
    * Get latest answers.
    *
    * @param array $with
    * @param $orderByColumn
    * @param $orderByDirection
    * @param $number
    * @return mixed
    */
   public function getLatestAnswers(array $with, $orderByColumn, $orderByDirection, $number);
}