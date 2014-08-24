<?php namespace MPP\Repository;

use Illuminate\Database\Eloquent\Model;
use StdClass;

/**
 * Class AbstractEloquentRepository
 *
 * @package MPP\Repository
 */
abstract class AbstractEloquentRepository implements Repository, Crudable, Panigable
{
   /**
    * Model.
    *
    * @var \Illuminate\Database\Eloquent\Model
    */
   protected $model;

   /**
    * Constructor.
    *
    * @param Model $model
    */
   public function __construct(Model $model)
   {
      $this->model = $model;
   }

   /**
    * Make.
    *
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Builder|mixed|static
    */
   public function make(array $with = array())
   {
      return $this->model->with($with);
   }

   /**
    * Make with condition.
    *
    * @param array $with
    * @param $key
    * @param $value
    * @return $this|mixed
    */
   public function makeWhere(array $with = array(), $key, $value)
   {
      return $this->model->with($with)->where($key, '=', $value);
   }

   /**
    * Get all entities.
    *
    * @param array $with
    * @return \Illuminate\Database\Eloquent\Collection|mixed|static[]
    */
   public function all(array $with = array())
   {
      $entity = $this->make($with);

      return $entity->get();
   }

   /**
    * Find an entity.
    *
    * @param $id
    * @param array $with
    * @return Model|mixed|null|static
    */
   public function find($id, array $with = array())
   {
      $entity = $this->make($with)->find($id);

      return $entity;
   }

   /**
    * Create an entity.
    *
    * @param array $data
    * @return mixed|static
    */
   public function create(array $data)
   {
      return $this->model->create($data);
   }

   /**
    * Update an entity.
    *
    * @param $id
    * @param array $data
    * @return bool|int|mixed
    */
   public function update($id, array $data)
   {
      return $this->model->update($data);
   }

   /**
    * Destroy an entity,
    *
    * @param $id
    * @return bool|mixed|null
    */
   public function destroy($id)
   {
      $entity = $this->find($id, array());

      if ($entity) {
         return $entity->delete();
      }
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

      $results->totalItems = $this->model->count();
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
    * @return Model|mixed|null|static
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