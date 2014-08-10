<?php namespace MPP\Repository;

/**
 * Interface Repository
 *
 * @package MPP\Repository
 */
interface Repository
{
   /**
    * Get all.
    *
    * @param array $with
    * @return mixed
    */
   public function all(array $with);

   /**
    * Get one by id.
    *
    * @param $id
    * @param array $with
    * @return mixed
    */
   public function find($id, array $with);

   /**
    * Create.
    *
    * @param array $data
    * @return mixed
    */
   public function create(array $data);

   /**
    * Update.
    *
    * @param array $data
    * @return mixed
    */
   public function update(array $data);

   /**
    * Delete.
    *
    * @param $id
    * @return mixed
    */
   public function destroy($id);

   /**
    * Make.
    *
    * @param array $with
    * @return mixed
    */
   public function make(array $with);

   /**
    * Make with condition.
    *
    * @param array $with
    * @param $key
    * @param $value
    * @return mixed
    */
   public function makeWhere(array $with, $key, $value);

   /**
    * Get results on a page.
    *
    * @param $page
    * @param $limit
    * @param array $with
    * @param $columnName
    * @param $columnDirection
    * @return mixed
    */
   public function getByPage($page, $limit, array $with, $columnName, $columnDirection);

   /**
    * Get results on a page with condition.
    *
    * @param $key
    * @param $value
    * @param $page
    * @param $limit
    * @param array $with
    * @param $columnName
    * @param $columnDirection
    * @return mixed
    */
   public function getByPageWhere($key, $value, $page, $limit, array $with, $columnName, $columnDirection);

   /**
    * Get one property with condition.
    *
    * @param $key
    * @param $value
    * @param array $with
    * @return mixed
    */
   public function getOneWhere($key, $value, array $with);

   /**
    * Get many properties with condition.
    *
    * @param $key
    * @param $value
    * @param array $with
    * @return mixed
    */
   public function getManyWhere($key, $value, array $with);

   /**
    * Order by.
    *
    * @param array $with
    * @param $column
    * @param $direction
    * @return mixed
    */
   public function orderBy(array $with, $column, $direction);
}
