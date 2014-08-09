<?php namespace MPP\Repository\Answer;

use MPP\Repository\Repository;
use Answer;

/**
 * Class EloquentAnswerRepository
 *
 * @package MPP\Repository\Answer
 */
class EloquentAnswerRepository implements Repository, AnswerRepository
{
   /**
    * Answer model.
    *
    * @var \Answer
    */
   protected $answer;

   public function __construct(Answer $answer)
   {
      $this->answer = $answer;
   }

   /**
    * Get all answers.
    *
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Builder|mixed|static
    */
   public function all(array $with = array())
   {
      $answers = $this->answer->with($with);

      return $answers;
   }

   /**
    * Find an answer by id.
    *
    * @param $id
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|mixed|null|static
    */
   public function find($id, array $with)
   {
      $answer = $this->answer->with($with)->find($id);

      return $answer;
   }

   /**
    * Create an answer.
    *
    * @param array $data
    * @return mixed|static
    */
   public function create(array $data)
   {
      return $this->answer->create($data);
   }

   /**
    * Update an answer.
    *
    * @param array $data
    * @return bool|int|mixed
    */
   public function update(array $data)
   {
      return $this->answer->update($data);
   }

   /**
    * Delete an answer.
    *
    * @param $id
    * @return bool|mixed|null
    */
   public function destroy($id)
   {
      $answer = $this->find($id, array());

      if ($answer) {
         return $answer->delete();
      }
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
