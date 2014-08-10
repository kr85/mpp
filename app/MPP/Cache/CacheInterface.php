<?php namespace MPP\Cache;

/**
 * Interface CacheInterface
 *
 * @package MPP\Cache
 */
interface CacheInterface
{
   /**
    * Get cache by key.
    *
    * @param $key
    * @return mixed
    */
   public function get($key);

   /**
    * Put cache by key, value, and minutes.
    *
    * @param $key
    * @param $value
    * @param null $minutes
    * @return mixed
    */
   public function put($key, $value, $minutes = null);

   /**
    * Check if cache exists by key.
    *
    * @param $key
    * @return mixed
    */
   public function has($key);
}