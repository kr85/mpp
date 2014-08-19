<?php namespace MPP\Validation;

use Illuminate\Validation\Factory as Validator;

abstract class AbstractValidator implements ValidationInterface
{
   protected $validator;

   protected $rules;

   protected $input;

   protected $errors;

   protected $messages;

   public function __construct(Validator $validator)
   {
      $this->validator = $validator;
      $this->rules = array();
      $this->input = array();
      $this->errors = array();
      $this->messages = array();
   }

   public function passes()
   {
      $validator = $this->validator->make(
         $this->input,
         $this->rules,
         $this->messages
      );
   }

   public function errors()
   {
      return $this->errors;
   }

   public function with(array $input)
   {
      $this->input = $input;

      return $this;
   }
}