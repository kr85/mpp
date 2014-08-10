<?php namespace MPP\Repository\Answer;

use MPP\Cache\CacheInterface;
use Answer;

/**
 * Class AnswerCacheDecorator
 *
 * @package MPP\Repository\Answer
 */
class AnswerCacheDecorator extends  AbstractAnswerDecorator
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
    * @param AnswerRepository $answerRepository
    * @param CacheInterface $cache
    * @param Answer $answer
    */
   public function __construct(AnswerRepository $answerRepository, CacheInterface $cache, Answer $answer)
   {
      parent::__construct($answerRepository, $answer);
      $this->cache = $cache;
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
      $key = md5('answer.id.' . $id);

      if ($this->cache->has($key)) {
         return $this->cache->get($key);
      }

      $answer = $this->answerRepository->find($id, $with);

      $this->cache->put($key, $answer);

      return $answer;
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
   public function getLatestAnswers(array $with, $orderByColumn, $orderByDirection, $number)
   {
      $key = md5('latest.answers');

      if ($this->cache->has($key)) {
         return $this->cache->get($key);
      }

      $answers = $this->answerRepository->getLatestAnswers($with, $orderByColumn, $orderByDirection, $number);

      $this->cache->put($key, $answers);

      return $answers;
   }
}