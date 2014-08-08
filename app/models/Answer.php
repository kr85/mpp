<?php

/**
 * Class Answer
 */
class Answer extends Eloquent
{
   /**
    * The name of the table.
    *
    * @var string
    */
   protected $table = 'answers';

   /**
    * Properties that can be mass assigned.
    *
    * @var array
    */
   protected $fillable = array(
      'question_id', 'user_id', 'answer',
      'correct',     'votes'
   );

   /**
    * Answer validation rules.
    *
    * @var array
    */
   public static $rules = array(
      'answer' => 'required|min:2'
   );

   /**
    * Get answer validation rules.
    *
    * @return array
    */
   public function getAnswerRules()
   {
      return $this::$rules;
   }

   /**
    * Answer belongs to user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function users()
   {
      return $this->belongsTo('User', 'user_id');
   }

   /**
    * Answer belongs to question.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function questions()
   {
      return $this->belongsTo('Question', 'question_id');
   }

   public function votes()
   {
      return $this->belongsToMany('Vote', 'answers_votes');
   }
}