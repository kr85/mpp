<?php namespace MPP\Validation;

/**
 * Class AbstractValidator
 *
 * @package MPP\Validation
 */
abstract class AbstractValidator
{
   /**
    * Validation instance.
    *
    * @var
    */
   protected $validator;

   /**
    * Validation rules.
    *
    * @var
    */
   protected $rules;

   /**
    * Input to be validated.
    *
    * @var array
    */
   protected $input;

   /**
    * Validation errors.
    *
    * @var array
    */
   protected $errors;

   /**
    * Constructor.
    */
   public function __construct()
   {
      $this->input = array();
      $this->errors = array();
   }

   /**
    * Passes the validation rules and input.
    *
    * @return mixed
    */
   abstract function passes();

   /**
    * Returns validation errors.
    *
    * @return array
    */
   public function errors()
   {
      return $this->errors;
   }

   /**
    * Sets data to validate.
    *
    * @param array $input
    * @return $this
    */
   public function with(array $input)
   {
      $this->input = $input;

      return $this;
   }
}