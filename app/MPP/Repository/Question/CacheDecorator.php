<?php namespace MPP\Repository\Question;

use MPP\Cache\CacheInterface;

/**
 * Class CacheDecorator
 *
 * @package MPP\Repository\Question
 */
class CacheDecorator extends AbstractQuestionDecorator
{
   /**
    * Cache interface.
    *
    * @var \MPP\Cache\CacheInterface
    */
   protected $cache;

   /**
    * Construct.
    *
    * @param QuestionRepository $questionRepository
    * @param CacheInterface $cache
    */
   public function __construct(QuestionRepository $questionRepository, CacheInterface $cache)
   {
      parent::__construct($questionRepository);
      $this->cache = $cache;
   }

   /**
    * All.
    *
    * @param array $with
    * @return mixed
    */
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

   /**
    * Find.
    *
    * @param $id
    * @param array $with
    * @return mixed
    */
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

   /**
    * Get latest.
    *
    * @param array $with
    * @param $orderByColumn
    * @param $orderByDirection
    * @param $number
    * @return mixed
    */
   public function getLatestQuestions(array $with, $orderByColumn, $orderByDirection, $number)
   {
      $key = md5('latest.questions');

      if ($this->cache->has($key)) {
         return $this->cache->get($key);
      }

      $questions = $this->questionRepository->getLatestQuestions($with, $orderByColumn, $orderByDirection, $number);

      $this->cache->put($key, $questions);

      return $questions;
   }
}

