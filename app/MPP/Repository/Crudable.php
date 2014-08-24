<?php namespace MPP\Repository;

/**
 * Interface Crudable
 *
 * @package MPP\Repository
 */
interface Crudable
{
   /**
    * Create.
    *
    * @param array $data
    * @return mixed
    */
   public function create(array $data);

   /**
    * Get one by id.
    *
    * @param $id
    * @param array $with
    * @return mixed
    */
   public function find($id, array $with);

   /**
    * Update.
    *
    * @param $id
    * @param array $data
    * @return mixed
    */
   public function update($id, array $data);

   /**
    * Delete.
    *
    * @param $id
    * @return mixed
    */
   public function destroy($id);
}
