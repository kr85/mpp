<?php namespace MPP\Form\Session;

use MPP\Repository\Session\SessionRepository;
use MPP\Validation\ValidationInterface;

class SessionForm
{
   protected $sessionRepository;

   protected $validator;

   protected $input;

   public function __construct(
      SessionRepository $sessionRepository,
      ValidationInterface $validationInterface
   )
   {
      $this->sessionRepository = $sessionRepository;
      $this->validator = $validationInterface;
   }

   public function save(array $input)
   {
      if (!$this->valid($input)) {
         return false;
      }

      return $this->sessionRepository->store($input);
   }

   public function errors()
   {
      return $this->validator->errors();
   }

   protected function valid(array $input)
   {
      return $this->validator->with($input)->passes();
   }
}