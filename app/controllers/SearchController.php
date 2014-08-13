<?php

class SearchController extends \BaseController
{
   protected $client;

   public function __construct()
   {
      $this->client = new \Solarium\Client(Config::get('solr'));
   }

   public function index()
   {
      if (Input::has('q')) {
         $select = array(
            'query' => Input::get('q'),
            'query_fields' => array('title', 'question', 'answer')
         );
      }
   }

}