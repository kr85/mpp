<?php

use MPP\Repository\Question\QuestionRepository;
use MPP\Repository\Answer\AnswerRepository;

/**
 * Class VotesController
 */
class VotesController extends \BaseController
{
   /**
    * Vote model.
    *
    * @var Vote
    */
   protected $vote;

   /**
    * Question repository.
    *
    * @var MPP\Repository\Question\QuestionRepository
    */
   protected $questionRepository;

   /**
    * Answer repository.
    *
    * @var MPP\Repository\Answer\AnswerRepository
    */
   protected $answerRepository;

   /**
    * Constructor.
    *
    * @param Vote $vote
    * @param QuestionRepository $questionRepository
    * @param AnswerRepository $answerRepository
    */
   public function __construct(
      Vote               $vote,
      QuestionRepository $questionRepository,
      AnswerRepository   $answerRepository
   )
   {
      $this->vote               = $vote;
      $this->questionRepository = $questionRepository;
      $this->answerRepository   = $answerRepository;
   }

   /**
    * Like a question.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse
    */
   public function likeQuestion($id)
   {
      $question = $this->questionRepository->find($id, array());

      if ($question) {
         $voteCheck = $this->vote->where('name', 'like');

         if ($voteCheck->count() == 0) {
            $voteInfo = $this->vote->create(array(
               'name' => 'like'
            ));
         } else {
            $voteInfo = $voteCheck->first();
         }

         $exists = DB::table('questions_votes')->where(array(
            'user_id' => Sentry::getUser()->getId(),
            'question_id' => $id,
            'vote_id' => $voteInfo->id
         ))->count();

         if ($exists == 0) {
            DB::table('questions_votes')->insert(array(
               'user_id' => Sentry::getUser()->getId(),
               'question_id' => $id,
               'vote_id' => $voteInfo->id
            ));

            $question->votes()->sync(array(
               'vote_id' => $voteInfo->id
            ));

            $likes = $question->votes + 1;

            $question->update(array(
               'votes' => $likes
            ));

            return Redirect::back()
               ->with('success', 'Liked the question successfully!');
         } else {
            return Redirect::back()
               ->with('error', 'Already liked the question!');
         }
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Question was not found!');
      }
   }

   /**
    * Unlike a question.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse
    */
   public function unlikeQuestion($id)
   {
      $question = $this->questionRepository->find($id, array());

      if ($question) {
         $voteCheck = $this->vote->where('name', 'like');

         if ($voteCheck->count() == 0) {
            $voteInfo = $this->vote->create(array(
               'name' => 'like'
            ));
         } else {
            $voteInfo = $voteCheck->first();
         }

         $exists = DB::table('questions_votes')->where(array(
            'user_id' => Sentry::getUser()->getId(),
            'question_id' => $id,
            'vote_id' => $voteInfo->id
         ))->count();

         if ($exists != 0) {
            DB::table('questions_votes')->where(array(
               'user_id' => Sentry::getUser()->getId(),
               'question_id' => $id,
               'vote_id' => $voteInfo->id
            ))->delete();

            $likes = $question->votes - 1;

            $question->update(array(
               'votes' => $likes
            ));

            return Redirect::back()
               ->with('success', 'Unliked the question successfully!');
         } else {
            return Redirect::back()
               ->with('error', 'Already unliked the question!');
         }
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Question was not found!');
      }
   }

   /**
    * Like an answer.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse
    */
   public function likeAnswer($id)
   {
      $answer = $this->answerRepository->find($id, array());

      if ($answer) {
         $voteCheck = $this->vote->where('name', 'like');

         if ($voteCheck->count() == 0) {
            $voteInfo = $this->vote->create(array(
               'name' => 'like'
            ));
         } else {
            $voteInfo = $voteCheck->first();
         }

         $exists = DB::table('answers_votes')->where(array(
            'user_id' => Sentry::getUser()->getId(),
            'answer_id' => $id,
            'vote_id' => $voteInfo->id
         ))->count();

         if ($exists == 0) {
            DB::table('answers_votes')->insert(array(
               'user_id' => Sentry::getUser()->getId(),
               'answer_id' => $id,
               'vote_id' => $voteInfo->id
            ));

            $answer->votes()->sync(array(
               'vote_id' => $voteInfo->id
            ));

            $likes = $answer->votes + 1;

            $answer->update(array(
               'votes' => $likes
            ));

            return Redirect::back()
               ->with('success', 'Liked the answer successfully!');
         } else {
            return Redirect::back()
               ->with('error', 'Already liked the answer!');
         }
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Answer was not found!');
      }
   }

   /**
    * Unlike an answer.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse
    */
   public function unlikeAnswer($id)
   {
      $answer = $this->answerRepository->find($id, array());

      if ($answer) {
         $voteCheck = $this->vote->where('name', 'like');

         if ($voteCheck->count() == 0) {
            $voteInfo = $this->vote->create(array(
               'name' => 'like'
            ));
         } else {
            $voteInfo = $voteCheck->first();
         }

         $exists = DB::table('answers_votes')->where(array(
            'user_id' => Sentry::getUser()->getId(),
            'answer_id' => $id,
            'vote_id' => $voteInfo->id
         ))->count();

         if ($exists != 0) {
            DB::table('answers_votes')->where(array(
               'user_id' => Sentry::getUser()->getId(),
               'answer_id' => $id,
               'vote_id' => $voteInfo->id
            ))->delete();

            $likes = $answer->votes - 1;

            $answer->update(array(
               'votes' => $likes
            ));

            return Redirect::back()
               ->with('success', 'Unliked the answer successfully!');
         } else {
            return Redirect::back()
               ->with('error', 'Already unliked the answer!');
         }
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Answer was not found!');
      }
   }
}