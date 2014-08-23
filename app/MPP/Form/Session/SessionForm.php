<?php namespace MPP\Form\Session;

use MPP\Repository\Session\SessionRepository;
use MPP\Validation\ValidationInterface;

/**
 * Class SessionForm
 *
 * @package MPP\Form\Session
 */
class SessionForm
{
   /**
    * Session repository.
    *
    * @var \MPP\Repository\Session\SessionRepository
    */
   protected $sessionRepository;

   /**
    * Validator.
    *
    * @var \MPP\Validation\ValidationInterface
    */
   protected $validator;

   /**
    * Constructor.
    *
    * @param SessionRepository $sessionRepository
    * @param ValidationInterface $validationInterface
    */
   public function __construct(
      SessionRepository   $sessionRepository,
      ValidationInterface $validationInterface
   )
   {
      $this->sessionRepository = $sessionRepository;
      $this->validator         = $validationInterface;
   }

   /**
    * Save the form if valid.
    *
    * @param array $input
    * @return bool|mixed
    */
   public function save(array $input)
   {
      if (!$this->valid($input)) {
         return false;
      }

      return $this->sessionRepository->store($input);
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

   /**
    * Check if valid.
    *
    * @param array $input
    * @return mixed
    */
   protected function valid(array $input)
   {
      return $this->validator->with($input)->passes();
   }
}