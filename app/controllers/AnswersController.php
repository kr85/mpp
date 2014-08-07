<?php

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

   protected $question;

   public function __construct(
      Answer $answer,
      Question $question
   )
   {
      $this->answer = $answer;
      $this->question = $question;
   }

   /**
    * Stores an answer to the database and displays it.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse
    */
   public function store($id)
	{
      $question = $this->question->find($id);

      if ($question) {
         $validation = Validator::make(Input::all(), $this->answer->getAnswerRules());

         if ($validation->passes()) {
            $this->answer->create(array(
               'question_id' => $question->id,
               'user_id'     => Sentry::getUser()->getId(),
               'answer'      => Input::get('answer')
            ));

            $question->update(array(
               'answered' => 1
            ));

            return Redirect::route('question.show', $id)
               ->with('success', 'Answer was successfully submitted!');
         } else {
            return Redirect::route('question.show', $id)
               ->withInput()
               ->withErrors($validation);
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
		$answer = $this->answer->with('questions')->find($id);

      if ($answer) {
         if (Sentry::getUser()->hasAccess('admin') || Sentry::getUser()->getId() == $answer->user_id) {
            $questionId = $answer->question_id;

            $question = $this->question->find($questionId);

            $answer->delete();

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
    * Updates the votes of an answer.
    *
    * @param $direction
    * @param $id
    * @return \Illuminate\Http\RedirectResponse|mixed
    */
   public function getVote($direction, $id)
   {
      if (Request::ajax()) {
         $answer = $this->answer->find($id);

         if ($answer) {
            if ($direction == 'up') {
               $vote = $answer->votes + 1;
            } else {
               $vote = $answer->votes - 1;
            }

            $answer->update(array(
               'votes' => $vote
            ));

            return $vote;
         } else {
            Response::make('FAIL', 400);
         }
      } else {
         return Redirect::route('question.index');
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
      $answer = $this->answer->with('questions')->find($id);

      if ($answer) {
         if (Sentry::getUser()->hasAccess('admin') || Sentry::getUser()->getId() == $answer->user_id) {
            $this->answer->where('question_id', $answer->question_id)->update(array(
               'correct' => 0
            ));

            $answer->update(array(
               'correct' => 1
            ));

            return Redirect::route('question.show', array(
                  $answer->question_id
            ))->with('success', 'Best answer was successfully chosen!');
         } else {
            return Redirect::route('question.show', array(
                  $answer->question_id
            ))->with('error', 'You don\'t have permissions to choose best answer!');
         }
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Answer was not found!');
      }
   }
}