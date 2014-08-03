<?php

use MPP\Repositories\Question\QuestionRepository;

/**
 * Class QuestionsController
 */
class QuestionsController extends \BaseController
{
   /**
    * Question model.
    *
    * @var Question
    */
   protected $question;

   /**
    * Question repository.
    *
    * @var MPP\Repositories\Question\QuestionRepository
    */
   protected $questionRepository;

   /**
    * Tag model.
    *
    * @var Tag
    */
   protected $tag;

   /**
    * Master layout.
    *
    * @var string
    */
   protected $layout = 'layouts.master';

   /**
    * Construct.
    *
    * @param Question $question
    * @param QuestionRepository $questionRepository
    * @param Tag $tag
    */
   public function __construct(
      Question $question = null,
      QuestionRepository $questionRepository = null,
      Tag $tag = null
   )
   {
      $this->question = $question;
      $this->questionRepository = $questionRepository;
      $this->tag = $tag;
   }

   /**
    * Displays Question index page.
    */
   public function index()
	{
		$this->layout->content = View::make('qa.index')
         ->with('title', 'Questions!')
         ->with('questions', $this->question->with('users', 'tags', 'answers')
            ->orderBy('id', 'desc')
            ->paginate(5)
         );
	}

   /**
    * Displays the Ask Question page.
    */
   public function create()
	{
		$this->layout->content = View::make('qa.create');
	}

   /**
    * Stores a question to the database.
    *
    * @return \Illuminate\Http\RedirectResponse
    */
   public function store()
	{
		$validation = Validator::make(Input::all(), $this->question->getQuestionRules());

      if ($validation->passes()) {
         $question = $this->question->create(array(
            'user_id'  => Sentry::getUser()->getId(),
            'title'    => Input::get('title'),
            'question' => Input::get('question')
         ));

         $questionId = $question->id;

         $question = $this->question->find($questionId);

         if (Str::length(Input::get('tags'))) {
            $tagsArray = explode(',', Input::get('tags'));

            if (count($tagsArray)) {
               foreach ($tagsArray as $tag) {
                  $tag = trim($tag);

                  if (Str::length(Str::slug($tag))) {
                     $tagName = Str::slug($tag);

                     $tagCheck = $this->tag->where('tag_name', $tagName);

                     if ($tagCheck->count() == 0) {
                        $tagInfo = $this->tag->create(array(
                           'tag'      => $tag,
                           'tag_name' => $tagName
                        ));
                     } else {
                        $tagInfo = $tagCheck->first();
                     }
                  }

                  $question->tags()->attach($tagInfo->id);
               }
            }
         }

         return Redirect::route('question.index')
            ->with('success','Your question has been successfully created! '.HTML::linkRoute(
                  'question.show', 'Click here to see your question',array(
                  'id'=> $questionId,'title' => Str::slug($question->title)
               )));

      } else {
         return Redirect::back()
            ->withInput()
            ->withErrors($validation);
      }
	}

   /**
    * Displays a question by id.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    */
   public function show($id)
	{
		$question = $this->question->with('users', 'tags', 'answers')->find($id);

      if ($question) {
         $question->update(array(
            'viewed' => $question->viewed + 1
         ));

         return $this->layout->content = View::make('qa.show')
            ->with('title', $question->title)
            ->with('question', $question);
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Question was not found!');
      }
	}

   /**
    * Displays the question edit page.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    */
   public function edit($id)
	{
		$question = $this->question->find($id);

      if ($question) {
         return $this->layout->content = View::make('qa.edit')
            ->with('question', $question);
      } else {
         return Redirect::back()
            ->with('error', 'Question was not found!');
      }
	}

	public function update($id)
	{
      $question = $this->question->find($id);

      $validation = Validator::make(Input::all(), $this->question->getQuestionRules());

      if ($validation->passes()) {
         $question->update(array(
            'title'    => Input::get('title'),
            'question' => Input::get('question')
         ));

         $questionId = $question->id;

         $question = $this->question->find($questionId);

         if (Str::length(Input::get('tags'))) {
            $tagsArray = explode(',', Input::get('tags'));

            if (count($tagsArray)) {
               foreach ($tagsArray as $tag) {
                  $tag = trim($tag);

                  if (Str::length(Str::slug($tag))) {
                     $tagName = Str::slug($tag);

                     $tagCheck = $this->tag->where('tag_name', $tagName);

                     if ($tagCheck->count() == 0) {
                        $tagInfo = $this->tag->update(array(
                           'tag'      => $tag,
                           'tag_name' => $tagName
                        ));
                     } else {
                        $tagInfo = $tagCheck->first();
                     }
                  }

                  $question->tags()->attach($tagInfo->id);
               }
            }
         }

         return Redirect::back()
            ->with('success','Your question has been successfully updated! '.HTML::linkRoute(
                  'question.show', 'Click here to see your question',array(
                  'id'=> $questionId,'title' => Str::slug($question->title)
               )));
      } else {
         return Redirect::back()
            ->withInput()
            ->withErrors($validation);
      }
	}

   /**
    * Deletes a question by id.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse
    */
   public function destroy($id)
	{
		$question = $this->question->find($id);

      if ($question) {
         $question->delete();

         return Redirect::route('question.index')
            ->with('success', 'Question was successfully deleted!');
      } else {
         return Redirect::back()
            ->with('error', 'Nothing to delete!');
      }
	}

   /**
    * Lock a question by id.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse
    */
   public function lock($id)
   {
      $question = $this->question->find($id);

      if ($question) {
         $question->update(array(
            'closed' => 1
         ));

         return Redirect::back()
            ->with('success', 'Question was successfully locked!');
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Question was not found!');
      }
   }

   /**
    * Unlocks a question by id.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse
    */
   public function unlock($id)
   {
      $question = $this->question->find($id);

      if ($question) {
         $question->update(array(
            'closed' => 0
         ));

         return Redirect::back()
            ->with('success', 'Question was successfully unlocked!');
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Question was not found!');
      }
   }

   /**
    * Displays questions by tag name.
    *
    * @param $tag
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    */
   public function getTaggedWith($tag)
   {
      $tag = $this->tag->where('tag_name', $tag)->first();

      if ($tag) {
         return View::make('qa.index')
            ->with('title', 'Questions Tagged With: ' . $tag->tag)
            ->with('questions', $tag->questions()
               ->with('users', 'tags', 'answers')
               ->paginate(5));
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Tag was not found!');
      }
   }
}