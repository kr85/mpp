<?php namespace MPP\Repository\Question;

interface QuestionRepository
{
   public function all(array $with);

   public function find($id, array $with);

   public function show($id);

   public function create(array $data);

   public function update(array $data);

   public function destroy($id);

   public function getLatestQuestions();

   public function with(array $data);

   //public function make(array $with);
}
