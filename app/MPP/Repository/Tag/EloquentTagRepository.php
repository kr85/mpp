<?php namespace MPP\Repository\Tag;

use MPP\Repository\AbstractEloquentRepository;
use Question;
use Tag;
use Str;
use Input;

/**
 * Class EloquentTagRepository
 *
 * @package MPP\Repository\Tag
 */
class EloquentTagRepository extends AbstractEloquentRepository implements TagRepository
{
   /**
    * Tag model.
    *
    * @var \Tag
    */
   protected $tag;

   /**
    * Question model.
    *
    * @var \Question
    */
   protected $question;

   /**
    * Constructor.
    *
    * @param Tag $tag
    * @param Question $question
    */
   public function __construct(Tag $tag, Question $question)
   {
      parent::__construct($tag);
      $this->tag = $tag;
      $this->question = $question;
   }

   /**
    * Handle tags.
    *
    * @param $questionId
    * @return mixed|void
    */
   public function handleTags($questionId)
   {
      $question = $this->question->find($questionId);

      if (Str::length(Input::get('tags'))) {
         $tagsArray = explode(',', \Input::get('tags'));

         if (count($tagsArray)) {
            foreach ($tagsArray as $tag) {
               $tag = trim($tag);

               if (Str::length(Str::slug($tag))) {
                  $tagName = Str::slug($tag);

                  $tagCheck = $this->tag->where('tag_name', $tagName);

                  if ($tagCheck->count() == 0) {
                     $tagInfo = $this->tag->create(array(
                        'tag'      => $tag,
                        'tag_name' => $tagName
                     ));
                  } else {
                     $tagInfo = $tagCheck->first();
                  }
               }

               $question->tags()->sync(array($tagInfo->id), false);
            }
         }
      }
   }
}