<?php

/**
 * Class Vote
 */
class Vote extends Eloquent
{
   protected $table = 'votes';

   protected $fillable = array('name');

   public function users()
   {
      return $this->belongsTo('User', 'questions_votes');
   }

   public function questions()
   {
      return $this->belongsToMany('Question', 'questions_votes');
   }
}