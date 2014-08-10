<?php namespace MPP\Filter;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Str;
use Cache;

/**
 * Class CacheFilter
 * 
 * @package MPP\Filter
 */
class CacheFilter
{
   /**
    * Cache expiration time.
    *
    * @var int
    */
   protected $minutes = 60;

   /**
    * Fetch.
    *
    * @param Route $route
    * @param Request $request
    * @return mixed
    */
   public function fetch(Route $route, Request $request)
   {
      $key = $this->makeCacheKey($request->url());

      if (Cache::has($key)) {
         return Cache::get($key);
      }
   }

   /**
    * Put.
    *
    * @param Route $route
    * @param Request $request
    * @param Response $response
    */
   public function put(Route $route, Request $request, Response $response)
   {
      $key = $this->makeCacheKey($request->url());

      if (!Cache::has($key)) {
         Cache::put($key, $response->getContent(), $this->minutes);
      }
   }

   /**
    * Make cache key.
    *
    * @param $url
    * @return string
    */
   protected function makeCacheKey($url)
   {
      return 'route_' . Str::slug($url);
   }
}