<?php namespace MPP\Cache\Question;

use MPP\Cache\CacheInterface;
use MPP\Repository\Question\AbstractQuestionDecorator;
use MPP\Repository\Question\QuestionRepository;
use Question;

/**
 * Class CacheDecorator
 *
 * @package MPP\Repository\Question
 */
class QuestionCacheDecorator extends AbstractQuestionDecorator
{
   /**
    * Cache interface.
    *
    * @var \MPP\Cache\CacheInterface
    */
   protected $cache;

   /**
    * Constructor.
    *
    * @param QuestionRepository $questionRepository
    * @param CacheInterface $cache
    * @param Question $question
    */
   public function __construct(QuestionRepository $questionRepository, CacheInterface $cache, Question $question)
   {
      parent::__construct($questionRepository, $question);
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
      $key = md5('question.id.' . $id);

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

