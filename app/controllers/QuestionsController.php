<?php

use MPP\Repository\Question\QuestionRepository;
use MPP\Validation\Question\QuestionFormValidator;
use MPP\Form\Question\QuestionForm;

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

   protected $questionForm;

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
    * Construct.
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
      QuestionFormValidator $questionFormValidator,
      QuestionForm $questionForm
   )
   {
      $this->question           = $question;
      $this->questionRepository = $questionRepository;
      $this->tag                = $tag;
      $this->validator          = $questionFormValidator;
      $this->questionForm   = $questionForm;
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
      $question = $this->questionForm->save($input);

      if ($question) {
         return Redirect::route('question.index')
            ->with('success','Your question has been successfully created! '.HTML::linkRoute(
                  'question.show', 'Click here to see your question', $question->id));

      } else {
         return Redirect::back()
            ->withInput()
            ->withErrors($this->questionForm->errors());
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
      $input = Input::all();

      $question = $this->questionForm->update($id, $input);

      if ($question) {
         return $this->layout->content = View::make('qa.show')
            ->with('title', $question->title)
            ->with('question', $question)
            ->with('success','Your question has been successfully updated!');
      } else {
         return Redirect::back()
            ->withInput()
            ->withErrors($this->questionForm->errors());
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