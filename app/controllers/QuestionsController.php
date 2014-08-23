<?php

use MPP\Repository\Question\QuestionRepository;
use MPP\Validation\Question\QuestionFormValidator;

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
    * @var MPP\Repository\Question\QuestionRepository
    */
   protected $questionRepository;

   /**
    * Tag model.
    *
    * @var Tag
    */
   protected $tag;

   /**
    * Question form validator.
    *
    * @var MPP\Validation\Question\QuestionFormValidator
    */
   protected $validator;

   /**
    * Questions/Answers layout.
    *
    * @var string
    */
   protected $layout = 'layouts.qa';

   /**
    * Number of items displayed on the page.
    *
    * @var int
    */
   private static $pageLimit = 4;

   /**
    * Constructor.
    *
    * @param Question $question
    * @param QuestionRepository $questionRepository
    * @param Tag $tag
    * @param QuestionFormValidator $questionFormValidator
    */
   public function __construct(
      Question              $question,
      QuestionRepository    $questionRepository,
      Tag                   $tag,
      QuestionFormValidator $questionFormValidator
   )
   {
      $this->question           = $question;
      $this->questionRepository = $questionRepository;
      $this->tag                = $tag;
      $this->validator          = $questionFormValidator;
   }

   /**
    * Displays Question index page.
    */
   public function index()
	{
      $page = Input::get('page', 1);
      $data = $this->questionRepository->getByPage($page, QuestionsController::$pageLimit, array('users', 'tags', 'answers', 'votes'), 'id', 'desc');
      $questions = Paginator::make($data->items, $data->totalItems, QuestionsController::$pageLimit);

		return $this->layout->content = View::make('qa.index')
         ->with('title', 'All Questions!')
         ->with('questions', $questions);
	}

   /**
    * Displays the Ask Question page.
    */
   public function create()
	{
		return $this->layout->content = View::make('qa.create');
	}

   /**
    * Stores a question to the database.
    *
    * @return \Illuminate\Http\RedirectResponse
    */
   public function store()
	{
      $input = Input::all();
      $validation = $this->validator->with($input);

      if ($validation->passes()) {
         $question = $this->questionRepository->create(array(
            'user_id'  => Sentry::getUser()->getId(),
            'title'    => trim(Input::get('title')),
            'question' => trim(Input::get('question'))
         ));

         $questionId = $question->id;
         $this->handleTags($questionId);

         return Redirect::route('question.index')
            ->with('success','Your question has been successfully created! '.HTML::linkRoute(
                  'question.show', 'Click here to see your question', $questionId));

      } else {
         return Redirect::back()
            ->withInput()
            ->withErrors($validation->errors());
      }
	}

   /**
    * Helper function. Handles tags.
    *
    * @param $questionId
    */
   protected function handleTags($questionId)
   {
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
   }

   /**
    * Displays a question by id.
    *
    * @param $id
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    */
   public function show($id)
	{
      $question = $this->questionRepository->find($id, array('users', 'tags', 'answers', 'votes'));

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
		$question = $this->questionRepository->find($id, array('users', 'tags', 'answers', 'votes'));

      if ($question) {
         return $this->layout->content = View::make('qa.edit')
            ->with('question', $question);
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Question was not found!');
      }
	}

   /**
    * Updates a question.
    *
    * @param $id
    * @return $this
    */
   public function update($id)
	{
      $question = $this->questionRepository->find($id, array('users', 'tags', 'answers', 'votes'));
      $input = Input::all();
      $validation = $this->validator->with($input);

      if ($validation->passes()) {
         $question->update(array(
            'title'    => trim(Input::get('title')),
            'question' => trim(Input::get('question'))
         ));

         return $this->layout->content = View::make('qa.show')
            ->with('title', $question->title)
            ->with('question', $question)
            ->with('success','Your question has been successfully updated!');
      } else {
         return Redirect::back()
            ->withInput()
            ->withErrors($validation->errors());
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
		$question = $this->questionRepository->find($id, array('users', 'tags', 'answers', 'votes'));

      if ($question) {
         $tags = $question->tags;
         $question->delete();
         foreach ($tags as $tag) {
            if (count($tag->questions) == 0) {
               $tag->delete();
            }
         }

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
      $question = $this->questionRepository->find($id, array('users', 'tags', 'answers', 'votes'));

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
      $question = $this->questionRepository->find($id, array('users', 'tags', 'answers', 'votes'));

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
    * Gets all the tags.
    *
    * @return $this
    */
   public function getTags()
   {
      $tags = $this->tag->with('questions')->orderBy('tag_name', 'asc')->get();

      return $this->layout->content = View::make('qa.tags')
         ->with('title', 'All Tags')
         ->with('tags', $tags);
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
      $questions = $tag->questions()->with('users', 'tags', 'answers', 'votes')->paginate(4);

      if ($tag) {
         return View::make('qa.index')
            ->with('title', 'Questions Tagged With: ' . $tag->tag)
            ->with('questions', $questions);
      } else {
         return Redirect::route('question.index')
            ->with('error', 'Tag was not found!');
      }
   }

   /**
    * Get questions with zero answers.
    *
    * @return $this
    */
   public function getUnanswered()
   {
      $page = Input::get('page', 1);
      $data = $this->questionRepository->getByPageWhere('answered', 0, $page, QuestionsController::$pageLimit, array('users', 'tags', 'answers', 'votes'), 'id', 'desc');;
      $questions = Paginator::make($data->items, $data->totalItems, 4);

      return $this->layout->content = View::make('qa.index')
         ->with('title', 'Unanswered Questions!')
         ->with('questions', $questions);
   }
}