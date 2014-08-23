<?php namespace MPP\Repository;

/**
 * Interface Panigable
 *
 * @package MPP\Repository
 */
interface Panigable
{
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
}