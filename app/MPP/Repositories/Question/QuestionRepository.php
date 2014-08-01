<?php namespace MPP\Repositories\Question;

interface QuestionRepository
{
   public function all();

   public function find($id, array $with);

   public function show($id);

   public function create($input);

   public function update($data);

   public function destroy($id);

   public function with(array $data);

   public function make(array $with);
}
