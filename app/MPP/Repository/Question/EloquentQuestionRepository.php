<?php namespace MPP\Repository\Question;

use MPP\Repository\AbstractEloquentRepository;
use Question;
use Sentry;
use Tag;

/**
 * Class EloquentQuestionRepository
 *
 * @package MPP\Repository\Question
 */
class EloquentQuestionRepository extends AbstractEloquentRepository implements QuestionRepository
{
   /**
    * Question model.
    *
    * @var \Question
    */
   protected $question;

   protected $tag;


   public function __construct(Question $question, Tag $tag)
   {
      parent::__construct($question);
      $this->question = $question;
      $this->tag = $tag;
   }

   public function create(array $input)
   {
      $question = $this->question->create(array(
         'user_id'  => Sentry::getUser()->getId(),
         'title'    => trim($input['title']),
         'question' => trim($input['question'])
      ));

      $questionId = $question->id;
      $this->handleTags($questionId);

      if (!$question) {
         return false;
      }

      return $question;
   }

   public function update($id, array $input)
   {
      $question = $this->question->find($id);

      if (!$question) {
         return false;
      }

      $question->title = trim($input['title']);
      $question->question = trim($input['question']);

      $question->save();

      return $question;
   }

   /**
    * Get latest added questions.
    *
    * @param array $with
    * @param $orderByColumn
    * @param $orderByDirection
    * @param $number
    * @return mixed
    */
   public function getLatestQuestions(array $with, $orderByColumn, $orderByDirection, $number)
   {
      return $this->question->with($with)->orderBy($orderByColumn, $orderByDirection)->take($number)->get();
   }

   /**
    * Helper function. Handles tags.
    *
    * @param $questionId
    */
   protected function handleTags($questionId)
   {
      $question = $this->question->find($questionId);

      if (\Str::length(\Input::get('tags'))) {
         $tagsArray = explode(',', \Input::get('tags'));

         if (count($tagsArray)) {
            foreach ($tagsArray as $tag) {
               $tag = trim($tag);

               if (\Str::length(\Str::slug($tag))) {
                  $tagName = \Str::slug($tag);

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

               $question->tags()->attach($tagInfo->id);
            }
         }
      }
   }
}
