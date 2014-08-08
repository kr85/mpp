<?php namespace MPP\Repository\Question;

use MPP\Cache\CacheInterface;

class CacheDecorator extends AbstractQuestionDecorator
{
   protected $cache;

   public function __construct(QuestionRepository $questionRepository = null, CacheInterface $cache)
   {
      parent::__construct($questionRepository);
      $this->cache = $cache;
   }

   public function all(array $with = array())
   {
      $key = md5('all');

      if ($this->cache->has($key)) {
         return $this->cache->get($key);
      }

      $questions = $this->questionRepository->all($with);

      $this->cache->put($key, $questions);

      return $questions;
   }

   public function find($id, array $with = array())
   {
      $key = md5('id.' . $id);

      if ($this->cache->has($key)) {
         return $this->cache->get($key);
      }

      $question = $this->questionRepository->find($id, $with);

      $this->cache->put($key, $question);

      return $question;
   }

   public function getLatestQuestions()
   {
      $key = md5('latest.questions');

      if ($this->cache->has($key)) {
         return $this->cache->get($key);
      }

      $questions = $this->questionRepository->getLatestQuestions();

      $this->cache->put($key, $questions);

      return $questions;
   }
}

