<?php namespace MPP\Cache;

use Illuminate\Cache\CacheManager;

/**
 * Class Cache
 *
 * @package MPP\Cache
 */
class Cache implements CacheInterface
{
   /**
    * Cache manager.
    *
    * @var \Illuminate\Cache\CacheManager
    */
   protected $cache;

   /**
    * Cache tag.
    *
    * @var
    */
   protected $tag;

   /**
    * Cache expiration in minutes.
    *
    * @var int
    */
   protected $minutes;

   /**
    * Constructor.
    *
    * @param CacheManager $cache
    * @param $tag
    * @param int $minutes
    */
   public function __construct(CacheManager $cache, $tag, $minutes = 60)
   {
      $this->cache = $cache;
      $this->tag = $tag;
      $this->minutes = $minutes;
   }

   /**
    * Get cache by key.
    *
    * @param $key
    * @return mixed
    */
   public function get($key)
   {
      return $this->cache->tags($this->tag)->get($key);
   }

   /**
    * Put cache by key, value, and minutes.
    *
    * @param $key
    * @param $value
    * @param null $minutes
    * @return mixed
    */
   public function put($key, $value, $minutes = null)
   {
      if (is_null($minutes)) {
         $minutes = $this->minutes;
      }

      return $this->cache->tags($this->tag)->put($key, $value, $minutes);
   }

   /**
    * Check if cache exists by key.
    *
    * @param $key
    * @return mixed
    */
   public function has($key)
   {
      return $this->cache->tags($this->tag)->has($key);
   }
}