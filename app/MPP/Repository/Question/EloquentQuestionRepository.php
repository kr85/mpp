<?php namespace MPP\Repository\Question;

use MPP\Repository\AbstractEloquentRepository;
use MPP\Repository\Tag\TagRepository;
use Question;
use Sentry;

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

   protected $tagRepository;

   /**
    * Constructor.
    *
    * @param Question $question
    * @param TagRepository $tagRepository
    */
   public function __construct(Question $question, TagRepository $tagRepository)
   {
      parent::__construct($question);
      $this->question = $question;
      $this->tagRepository = $tagRepository;
   }

   /**
    * Create a new question.
    *
    * @param array $input
    * @return bool|mixed|static
    */
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

   /**
    * Update a question.
    *
    * @param $id
    * @param array $input
    * @return bool|\Illuminate\Support\Collection|int|mixed|static
    */
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
      $this->tagRepository->handleTags($questionId);
   }
}
