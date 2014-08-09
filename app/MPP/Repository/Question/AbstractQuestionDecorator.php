<?php namespace MPP\Repository\Question;

use MPP\Repository\Question\QuestionRepository;

/**
 * Class AbstractQuestionDecorator
 *
 * @package MPP\Repository\Question
 */
abstract class AbstractQuestionDecorator implements QuestionRepository
{
   /**
    * Question repository.
    *
    * @var QuestionRepository
    */
   protected $questionRepository;

   /**
    * Construct.
    *
    * @param QuestionRepository $questionRepository
    */
   public function __construct(QuestionRepository $questionRepository)
   {
      $this->questionRepository = $questionRepository;
   }

   /**
    * All.
    *
    * @param array $with
    * @return mixed
    */
   public function all(array $with = array())
   {
      return $this->questionRepository->all($with);
   }

   /**
    * Find.
    *
    * @param $id
    * @param array $with
    * @return mixed
    */
   public function find($id, array $with = array())
   {
      return $this->questionRepository->find($id, $with);
   }

   /**
    * Create,
    *
    * @param array $data
    * @return mixed
    */
   public function create(array $data)
   {
      return $this->questionRepository->create($data);
   }

   /**
    * Update.
    *
    * @param array $data
    * @return mixed
    */
   public function update(array $data)
   {
      return $this->questionRepository->update($data);
   }

   /**
    * Delete.
    *
    * @param $id
    * @return mixed
    */
   public function destroy($id)
   {
      return $this->questionRepository->destroy($id);
   }
}