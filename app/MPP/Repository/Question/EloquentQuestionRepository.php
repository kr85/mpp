<?php namespace MPP\Repository\Question;

use MPP\Repository\Repository;
use Question;

/**
 * Class EloquentQuestionRepository
 *
 * @package MPP\Repository\Question
 */
class EloquentQuestionRepository implements Repository, QuestionRepository
{
   /**
    * Question model.
    *
    * @var \Question
    */
   protected $question;

   /**
    * Construct.
    *
    * @param Question $question
    */
   public function __construct(Question $question)
   {
      $this->question = $question;
   }

   /**
    * Get all questions.
    *
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Builder|static
    */
   public function all(array $with = array())
   {
      $questions = $this->question->with($with);

      return $questions;
   }

   /**
    * Find a question.
    *
    * @param $id
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
    */
   public function find($id, array $with = array())
   {
      $question = $this->question->with($with)->find($id);

      return $question;
   }

   /**
    * Create a question.
    *
    * @param array $data
    * @return static
    */
   public function create(array $data)
   {
      return $this->question->create($data);
   }

   /**
    * Update a question.
    *
    * @param array $data
    * @return bool|int
    */
   public function update(array $data)
   {
      return $this->question->update($data);
   }

   /**
    * Delete a question.
    *
    * @param $id
    * @return bool|null
    */
   public function destroy($id)
   {
      $question = $this->find($id);

      if ($question) {
         return $question->delete();
      }
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
