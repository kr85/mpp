<?php namespace MPP\Validation;

use Illuminate\Validation\Factory as Validator;

/**
 * Class LaravelValidator
 *
 * @package MPP\Validation
 */
abstract class LaravelValidator extends AbstractValidator
{
   /**
    * Validation instance.
    *
    * @var \Illuminate\Validation\Factory
    */
   protected $validator;

   /**
    * Constructor.
    *
    * @param Validator $validator
    */
   public function __construct(Validator $validator)
   {
      $this->validator = $validator;
   }

   /**
    * Passes the rules and input for validation.
    *
    * @return bool|mixed
    */
   public function passes()
   {
      $validator = $this->validator->make(
         $this->input,
         $this->rules
      );

      if ($validator->fails()) {
         $this->errors = $validator->messages();
         return false;
      }

      return true;
   }
}