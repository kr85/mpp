<?php

class Question extends \Eloquent
{
	protected $fillable = array(
      'title',    'question', 'user_id',
      'answered', 'viewed',   'votes'
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

}