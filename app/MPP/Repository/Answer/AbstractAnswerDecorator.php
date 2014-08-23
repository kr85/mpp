<?php namespace MPP\Repository\Answer;

use Answer;

/**
 * Class AbstractAnswerDecorator
 *
 * @package MPP\Repository\Answer
 */
abstract class AbstractAnswerDecorator implements AnswerRepository
{
   /**
    * Answer repository.
    *
    * @var AnswerRepository
    */
   protected $answerRepository;

   /**
    * Answer model.
    *
    * @var Answer
    */
   protected $answer;

   /**
    * Constructor.
    *
    * @param AnswerRepository $answerRepository
    * @param Answer $answer
    */
   public function __construct(AnswerRepository $answerRepository, Answer $answer)
   {
      $this->answerRepository = $answerRepository;
      $this->answer            = $answer;
   }

   /**
    * All.
    *
    * @param array $with
    * @return mixed
    */
   public function all(array $with = array())
   {
      return $this->answerRepository->all($with);
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
      return $this->answerRepository->find($id, $with);
   }

   /**
    * Create,
    *
    * @param array $data
    * @return mixed
    */
   public function create(array $data)
   {
      return $this->answerRepository->create($data);
   }

   /**
    * Update.
    *
    * @param array $data
    * @return mixed
    */
   public function update(array $data)
   {
      return $this->answerRepository->update($data);
   }

   /**
    * Delete.
    *
    * @param $id
    * @return mixed
    */
   public function destroy($id)
   {
      return $this->answerRepository->destroy($id);
   }

   /**
    * Make.
    *
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Builder|mixed|static
    */
   public function make(array $with = array())
   {
      return $this->answer->with($with);
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
      return $this->answer->with($with)->where($key, '=', $value);
   }

   /**
    * Get one entity with a condition.
    *
    * @param $key
    * @param $value
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Model|mixed|null|static
    */
   public function getOneWhere($key, $value, array $with = array())
   {
      return $this->make($with)->where($key, '=', $value)->first();
   }

   /**
    * Get all entities with a condition.
    *
    * @param $key
    * @param $value
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Collection|mixed|static[]
    */
   public function getManyWhere($key, $value, array $with = array())
   {
      return $this->make($with)->where($key, '=', $value)->get();
   }

   /**
    * Order by.
    *
    * @param array $with
    * @param $columnName
    * @param $columnDirection
    * @return mixed
    */
   public function orderBy(array $with = array(), $columnName, $columnDirection)
   {
      return $this->make($with)->orderBy($columnName, $columnDirection)->get();
   }
}