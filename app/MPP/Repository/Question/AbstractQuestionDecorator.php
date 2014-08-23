<?php namespace MPP\Repository\Question;

use Question;
use StdClass;

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

   /**
    * Constructor.
    *
    * @param QuestionRepository $questionRepository
    * @param Question $question
    */
   public function __construct(QuestionRepository $questionRepository, Question $question)
   {
      $this->questionRepository = $questionRepository;
      $this->question = $question;
   }

   /**
    * Get all.
    *
    * @param array $with
    * @return mixed
    */
   public function all(array $with = array())
   {
      return $this->questionRepository->all($with);
   }

   /**
    * Find by id.
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
    * Get results on a page.
    *
    * @param $page
    * @param $limit
    * @param array $with
    * @param $columnName
    * @param $columnDirection
    * @return mixed|StdClass
    */
   public function getByPage($page, $limit, array $with = array(), $columnName, $columnDirection)
   {
      $results = new StdClass;
      $results->page = $page;
      $results->limit = $limit;
      $results->totalItems = 0;
      $results->items = array();

      $query = $this->make($with)->orderBy($columnName, $columnDirection);

      $entities = $query->skip($limit * ($page - 1))->take($limit)->get();

      $results->totalItems = $this->question->count();
      $results->items = $entities->all();

      return $results;
   }

   /**
    * Get results on a page with a condition.
    *
    * @param $key
    * @param $value
    * @param $page
    * @param $limit
    * @param array $with
    * @param $columnName
    * @param $columnDirection
    * @return mixed|StdClass
    */
   public function getByPageWhere($key, $value, $page, $limit, array $with = array(), $columnName, $columnDirection)
   {
      $results = new StdClass;
      $results->page = $page;
      $results->limit = $limit;
      $results->totalItems = 0;
      $results->items = array();

      $query = $this->makeWhere($with, $key, $value)->orderBy($columnName, $columnDirection);
      $model = $query->get();
      $entities = $query->skip($limit * ($page - 1))->take($limit)->get();

      $results->totalItems = $model->count();
      $results->items = $entities->all();

      return $results;
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
    * @return mixed|void
    */
   public function orderBy(array $with = array(), $columnName, $columnDirection)
   {
      return $this->make($with)->orderBy($columnName, $columnDirection)->get();
   }
}