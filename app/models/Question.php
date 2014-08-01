<?php

/**
 * Class Question
 */
class Question extends \Eloquent
{
   /**
    * Properties that can be mass assigned.
    *
    * @var array
    */
   protected $fillable = array(
      'title',    'question', 'user_id',
      'answered', 'viewed',   'votes',
      'closed'
   );

   /**
    * Question validation rules.
    *
    * @var array
    */
   public static $rules = array(
      'title'    => 'required|min:3',
      'question' => 'required|min:10'
   );

   /**
    * Question belongs to user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function users()
   {
      return $this->belongsTo('User', 'user_id');
   }

   /**
    * Question belongs to tags.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function tags()
   {
      return $this->belongsToMany('Tag', 'questions_tags')
         ->withTimestamps();
   }

   /**
    * Question has answers.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function answers()
   {
      return $this->hasMany('Answer', 'question_id');
   }

   /**
    * Get question validation rules.
    *
    * @return array
    */
   public function getQuestionRules()
   {
      return $this::$rules;
   }

}