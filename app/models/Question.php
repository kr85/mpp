<?php

class Question extends \Eloquent
{
	protected $fillable = array(
      'title',    'question', 'user_id',
      'answered', 'viewed',   'votes'
   );

   public static $rules = array(
      'title'    => 'required|min:3',
      'question' => 'required|min:10'
   );

   public function users()
   {
      return $this->belongsTo('User', 'user_id');
   }

   public function tags()
   {
      return $this->belongsToMany('Tag', 'questions_tags')
         ->withTimestamps();
   }

   public function getQuestionRules()
   {
      return $this::$rules;
   }

}