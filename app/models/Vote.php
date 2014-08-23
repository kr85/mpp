<?php

/**
 * Class Vote
 */
class Vote extends Eloquent
{
   /**
    * Name of the table.
    *
    * @var string
    */
   protected $table = 'votes';

   /**
    * Properties that can be mass assigned.
    *
    * @var array
    */
   protected $fillable = array('name');

   /**
    * Belongs to a user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function users()
   {
      return $this->belongsTo('User', 'questions_votes', 'answers_votes');
   }

   /**
    * Belongs to a question.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function questions()
   {
      return $this->belongsToMany('Question', 'questions_votes');
   }

   /**
    * Belongs to an answer.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function answers()
   {
      return $this->belongsToMany('Answer', 'answers_votes');
   }
}