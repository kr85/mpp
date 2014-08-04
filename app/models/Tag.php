<?php

/**
 * Class Tag
 */
class Tag extends \Eloquent
{
   /**
    * The name of the table.
    *
    * @var string
    */
   protected $table = 'tags';

   /**
    * Properties that can be mass assigned.
    *
    * @var array
    */
   protected $fillable = array(
      'tag', 'tag_name'
   );

   /**
    * Tag belongs to many questions.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function questions()
   {
      return $this->belongsToMany('Question', 'questions_tags')
         ->withTimestamps();
   }
}