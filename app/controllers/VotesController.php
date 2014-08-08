<?php

class VotesController extends \BaseController
{
   protected $question;
   protected $answer;
   protected $vote;

   public function __construct(Question $question, Answer $answer, Vote $vote)
   {
      $this->question = $question;
      $this->answer = $answer;
      $this->vote = $vote;
   }

   public function likeQuestion($id)
   {
      $question = $this->question->find($id);

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

   public function unlikeQuestion($id)
   {
      $question = $this->question->find($id);

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

   public function likeAnswer($id)
   {
      $answer = $this->answer->find($id);

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

   public function unlikeAnswer($id)
   {
      $answer = $this->answer->find($id);

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