<?php namespace MPP\Cache;

interface CacheInterface
{
   public function get($key);

   public function put($key, $value, $minutes = null);

   public function has($key);
}