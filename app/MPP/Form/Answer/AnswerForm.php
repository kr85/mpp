<?php namespace MPP\Form\Answer;

use MPP\Form\AbstractForm;
use MPP\Repository\Answer\AnswerRepository;
use MPP\Validation\ValidationInterface;

/**
 * Class AnswerForm
 *
 * @package MPP\Form\Answer
 */
class AnswerForm extends AbstractForm
{
   /**
    * Constructor.
    *
    * @param AnswerRepository $answerRepository
    * @param ValidationInterface $validationInterface
    */
   public function __construct(
      AnswerRepository    $answerRepository,
      ValidationInterface $validationInterface
   )
   {
      $this->repository = $answerRepository;
      $this->validator  = $validationInterface;
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

      return $this->repository->create($input);
   }
}