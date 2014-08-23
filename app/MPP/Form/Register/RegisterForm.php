<?php namespace MPP\Form\Register;

use MPP\Repository\Register\RegisterRepository;
use MPP\Validation\ValidationInterface;

class RegisterForm
{
   protected $registerRepository;

   protected $validator;

   public function __construct(
      RegisterRepository  $registerRepository,
      ValidationInterface $validationInterface
   )
   {
      $this->registerRepository = $registerRepository;
      $this->validator          = $validationInterface;
   }

   public function save(array $input)
   {
      if (!$this->valid($input)) {
         return false;
      }

      return $this->registerRepository->store($input);
   }

   /**
    * Return validation errors.
    *
    * @return mixed
    */
   public function errors()
   {
      return $this->validator->errors();
   }

   protected function valid(array $input)
   {
      return $this->validator->with($input)->passes();
   }
}
