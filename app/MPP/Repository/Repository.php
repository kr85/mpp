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
