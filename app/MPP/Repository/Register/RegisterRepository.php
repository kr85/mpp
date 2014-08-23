<?php namespace MPP\Repository\Register;

/**
 * Interface RegisterRepository
 *
 * @package MPP\Repository\Register
 */
interface RegisterRepository
{
   /**
    * Register a new user.
    *
    * @param $input
    * @return mixed
    */
   public function store($input);
}
