<?php namespace MPP\Repository\Question;

use MPP\Repository\Question\QuestionRepository;

abstract class AbstractQuestionDecorator implements QuestionRepository
{
   protected $questionRepository;

   public function __construct(QuestionRepository $questionRepository = null)
   {
      $this->questionRepository = $questionRepository;
   }

   public function all(array $with = array())
   {
      return $this->questionRepository->all($with);
   }

   public function find($id, array $with = array())
   {
      return $this->questionRepository->find($id, $with);
   }

   public function show($id)
   {
      return $this->questionRepository->show($id);
   }

   public function create(array $data)
   {
      return $this->questionRepository->create($data);
   }

   public function update(array $data)
   {
      return $this->questionRepository->update($data);
   }

   public function destroy($id)
   {
      return $this->questionRepository->destroy($id);
   }
}