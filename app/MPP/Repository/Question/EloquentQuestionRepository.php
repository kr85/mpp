<?php namespace MPP\Repository\Question;

use Question;

class EloquentQuestionRepository implements QuestionRepository
{
   protected $question;
   protected $data;

   public function __construct(Question $question)
   {
      $this->question = $question;
      $this->data = array();
   }

   public function all(array $with = array())
   {
      $questions = $this->question->with($with);

      return $questions;
   }

   public function find($id, array $with = array())
   {
      $question = $this->question->with($with)->find($id);

      return $question;
   }

   /*public function make(array $with = array())
   {
      return $this->question->with($with);
   }*/

   public function with(array $data)
   {
      $this->data = $data;

      return $this->data;
   }

   public function show($id)
   {
      $question = $this->question->with('users', 'tags', 'answers')->find($id);

      return $question;
   }

   public function create(array $data)
   {
      return $this->question->create($data);
   }

   public function update(array $data)
   {
      return $this->question->update($data);
   }

   public function destroy($id)
   {
      $question = $this->find($id);

      if ($question) {
         return $question->delete();
      }
   }

   public function getLatestQuestions()
   {
      return $this->question->with('users', 'answers', 'tags')->take(10)->orderBy('id', 'desc')->get();
   }
}
