<?php namespace MPP\Repository\Question;

use Question;

/**
 * Class AbstractQuestionDecorator
 *
 * @package MPP\Repository\Question
 */
abstract class AbstractQuestionDecorator implements QuestionRepository
{
   /**
    * Question repository.
    *
    * @var QuestionRepository
    */
   protected $questionRepository;

   /**
    * Question model.
    *
    * @var Question
    */
   protected $question;

   public function __construct(QuestionRepository $questionRepository, Question $question)
   {
      $this->questionRepository = $questionRepository;
      $this->question = $question;
   }

   /**
    * All.
    *
    * @param array $with
    * @return mixed
    */
   public function all(array $with = array())
   {
      return $this->questionRepository->all($with);
   }

   /**
    * Find.
    *
    * @param $id
    * @param array $with
    * @return mixed
    */
   public function find($id, array $with = array())
   {
      return $this->questionRepository->find($id, $with);
   }

   /**
    * Create,
    *
    * @param array $data
    * @return mixed
    */
   public function create(array $data)
   {
      return $this->questionRepository->create($data);
   }

   /**
    * Update.
    *
    * @param array $data
    * @return mixed
    */
   public function update(array $data)
   {
      return $this->questionRepository->update($data);
   }

   /**
    * Delete.
    *
    * @param $id
    * @return mixed
    */
   public function destroy($id)
   {
      return $this->questionRepository->destroy($id);
   }

   /**
    * Make.
    *
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Builder|mixed|static
    */
   public function make(array $with = array())
   {
      return $this->question->with($with);
   }

   /**
    * Make with a condition.
    *
    * @param array $with
    * @param $key
    * @param $value
    * @return $this|mixed
    */
   public function makeWhere(array $with = array(), $key, $value)
   {
      return $this->question->with($with)->where($key, '=', $value);
   }

   /**
    * Unimplemented methods,
    */
   public function getByPage($page, $limit, array $with = array(), $columnName, $columnDirection){}
   public function getByPageWhere($key, $value, $page, $limit, array $with, $columnName, $columnDirection){}
   public function getOneWhere($key, $value, array $with = array()){}
   public function getManyWhere($key, $value, array $with = array()){}
   public function orderBy(array $with = array(), $columnName, $columnDirection){}
}