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
}
