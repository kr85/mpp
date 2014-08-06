<?php namespace MPP\Repositories\Question;

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

   public function all()
   {
      return Question::all();
   }

   public function latestTen()
   {
      $this->question->orderBy('id', 'desc')->get(10);
   }

   public function find($id, array $with = array())
   {
      //$entity = $this->make($with);

      //return $entity->find($id);

      $question = $this->question->with($with)->find($id);

      return $question;
   }

   public function make(array $with = array())
   {
      return $this->question->with($with);
   }

   public function with(array $data)
   {
      $this->data = $data;

      return $this;
   }

   public function show($id)
   {
      $question = $this->question->with('users', 'tags', 'answers')->find($id);

      return $question;
   }

   public function create($input)
   {
      // TODO: Implement create() method.
   }

   public function update($data)
   {
      // TODO: Implement update() method.
   }

   public function destroy($id)
   {
      // TODO: Implement destroy() method.
   }
}
