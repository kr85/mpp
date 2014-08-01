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

   /**
    * Construct.
    *
    * @param Answer $answer
    */
   public function __construct(Answer $answer)
   {
      $this->answer = $answer;
   }

   /**
    * Stores an answer to the database and displays it.
    *
    * @param $id
    * @param $title
    * @return \Illuminate\Http\RedirectResponse
    */
   public function store($id, $title)
	{
      $question = Question::find($id);

      if ($question) {
         $validation = Validator::make(Input::all(), $this->answer->getAnswerRules());

         if ($validation->passes()) {
            $this->answer->create(array(
               'question_id' => $question->id,
               'user_id'     => Sentry::getUser()->getId(),
               'answer'      => Input::get('answer')
            ));

            return Redirect::route('question.show', array($id, $title))
               ->with('success', 'Answer was submitted successfully!');
         } else {
            return Redirect::route('question.show', array($id, $title))
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
		//
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
		$answer = Answer::with('questions')->find($id);

      if ($answer) {
         if (Sentry::getUser()->hasAccess('admin') || Sentry::getUser()->getId() == $answer->user_id) {
            $delete = Answer::find($id)->delete();

            return Redirect::route('question.show', array(
                  $answer->question_id, Str::slug($answer->questions->title
               )
            ))->with('success', 'Answer was deleted successfully!');
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
         $answer = Answer::find($id);

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
      $answer = Answer::with('questions')->find($id);

      if ($answer) {
         if (Sentry::getUser()->hasAccess('admin') || Sentry::getUser()->getId() == $answer->user_id) {
            Answer::where('question_id', $answer->question_id)->update(array(
               'correct' => 0
            ));

            $answer->update(array(
               'correct' => 1
            ));

            return Redirect::route('question.show', array(
                  $answer->question_id, Str::slug($answer->questions->title
               )
            ))->with('success', 'Best answer was chosen successfully!');
         } else {
            return Redirect::route('question.show', array(
                  $answer->question_id, Str::slug($answer->questions->title
               )
            ))->with('error', 'You don\'t have permissions to choose best answer!');
         }
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Answer was not found!');
      }
   }
}