<?php

class Tag extends \Eloquent
{
	protected $fillable = array(
      'tag', 'tag_name'
   );

   public function questions()
   {
      return $this->belongsToMany('Question', 'questions_tags')
         ->withTimestamps();
   }
}