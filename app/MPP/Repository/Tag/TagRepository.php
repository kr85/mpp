<?php namespace MPP\Repository\Tag;

use MPP\Repository\Crudable;
use MPP\Repository\Panigable;
use MPP\Repository\Repository;

/**
 * Interface TagRepository
 *
 * @package MPP\Repository\Tag
 */
interface TagRepository extends Repository, Crudable, Panigable
{
   /**
    * Handle tags.
    *
    * @param $questionId
    * @return mixed
    */
   public function handleTags($questionId);
}