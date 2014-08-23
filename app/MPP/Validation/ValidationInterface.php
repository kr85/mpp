<?php namespace MPP\Validation;

/**
 * Interface ValidationInterface
 *
 * @package MPP\Validation
 */
interface ValidationInterface
{
   /**
    * Passes the validation rules and input.
    *
    * @return mixed
    */
   public function passes();

   /**
    * Returns validation errors.
    *
    * @return mixed
    */
   public function errors();

   /**
    * Sets input to validate.
    *
    * @param array $input
    * @return mixed
    */
   public function with(array $input);
}