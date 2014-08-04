<?php

/**
 * Class Vote
 */
class Vote extends Eloquent
{
   /**
    * The name of the table.
    *
    * @var string
    */
   protected $table = 'votes';

   protected $fillable = array('user_id, answer_id');

   public function users()
   {
      return $this->belongsTo('User', 'vote');
   }

   public function answers()
   {
      return $this->belongsTo('Answer', 'vote');
   }
}