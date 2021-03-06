<?php

use MPP\Repository\Answer\AnswerRepository;
use MPP\Repository\Question\QuestionRepository;
use MPP\Validation\Answer\AnswerFormValidator;

/**
 * Class AnswersController
 */
class AnswersController extends \BaseController
{
   /**
    * Answer model.
    *
    * @var Answer
    */
   protected $answer;

   /**
    * Question model.
    *
    * @var
    */
   protected $question;

   /**
    * Answer repository.
    *
    * @var MPP\Repository\Answer\AnswerRepository
    */
   protected $answerRepository;

   /**
    * Question repository.
    *
    * @var MPP\Repository\Question\QuestionRepository
    */
   protected $questionRepository;

   /**
    * Answer form validator.
    *
    * @var
    */
   protected $validator;

   /**
    * Constructor.
    *
    * @param Answer $answer
    * @param Question $question
    * @param AnswerRepository $answerRepository
    * @param QuestionRepository $questionRepository
    * @param AnswerFormValidator $answerFormValidator
    */
   public function __construct(
      Answer              $answer,
      Question            $question,
      AnswerRepository    $answerRepository,
      QuestionRepository  $questionRepository,
      AnswerFormValidator $answerFormValidator
   )
   {
      $this->answer             = $answer;
      $this->question           = $question;
      $this->answerRepository   = $answerRepository;
      $this->questionRepository = $questionRepository;
      $this->validator          = $answerFormValidator;
   }

   /**
    * Stores an answer to the database and displays it.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse
    */
   public function store($id)
	{
      $question = $this->questionRepository->find($id, array());

      if ($question) {
         $input = Input::all();
         $validation = $this->validator->with($input);

         if ($validation->passes()) {
            $this->answerRepository->create(array(
               'question_id' => $question->id,
               'user_id'     => Sentry::getUser()->getId(),
               'answer'      => trim(Input::get('answer'))
            ));

            $question->update(array(
               'answered' => 1
            ));

            return Redirect::route('question.show', $id)
               ->with('success', 'Answer was successfully submitted!');
         } else {
            return Redirect::route('question.show', $id)
               ->withInput()
               ->withErrors($validation->errors());
         }
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Question was not found!');
      }
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		if (Request::ajax()) {
         $answer = $this->answer->find($id);

         if ($answer) {
            return $answer->id;
         } else {
            Response::make('FAIL', 400);
         }
      } else {
         return Redirect::route('question.index');
      }
	}

	public function update($id)
	{
		//
	}

   /**
    * Deletes an answer by id.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse
    */
   public function destroy($id)
	{
		$answer = $this->answerRepository->find($id, array('questions', 'votes'));

      if ($answer) {
         if (Sentry::getUser()->hasAccess('admin') || Sentry::getUser()->getId() == $answer->user_id) {
            $answer->delete();
            $question = $this->questionRepository->find($answer->question_id, array('users', 'tags', 'answers', 'votes'));

            if (count($question->answers) == 0) {
               $question->update(array(
                  'answered' => 0
               ));
            }

            return Redirect::route('question.show', $answer->question_id)
               ->with('success', 'Answer was successfully deleted!');
         } else {

         }
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Answer was not found!');
      }
	}

   /**
    * Selects a best answer.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse
    */
   public function getChooseBestAnswer($id)
   {
      $answer = $this->answerRepository->find($id, array('questions'));

      if ($answer) {
         if (Sentry::getUser()->hasAccess('admin') || Sentry::getUser()->getId() == $answer->user_id) {
            $this->answer->where('question_id', $answer->question_id)->update(array(
               'correct' => 0
            ));

            $answer->update(array(
               'correct' => 1
            ));

            return Redirect::route('question.show', $answer->question_id)
               ->with('success', 'Best answer was successfully chosen!');
         } else {
            return Redirect::route('question.show', $answer->question_id)
               ->with('error', 'You don\'t have permissions to choose best answer!');
         }
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Answer was not found!');
      }
   }
}