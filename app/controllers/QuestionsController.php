<?php

class QuestionsController extends \BaseController
{
   protected $question;
   protected $layout = 'layouts.master';

   public function __construct(Question $question)
   {
      $this->question = $question;
   }

	public function index()
	{
		$this->layout->content = View::make('qa.index')
         ->with('title', 'Hot Questions!')
         ->with('questions', Question::with('users', 'tags')
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

	public function store()
	{
		$validation = Validator::make(Input::all(), $this->question->getQuestionRules());

      if ($validation->passes()) {
         $question = Question::create(array(
            'user_id'  => Sentry::getUser()->getId(),
            'title'    => Input::get('title'),
            'question' => Input::get('question')
         ));

         $questionId = $question->id;

         $question = Question::find($questionId);

         if (Str::length(Input::get('tags'))) {
            $tagsArray = explode(',', Input::get('tags'));

            if (count($tagsArray)) {
               foreach ($tagsArray as $tag) {
                  $tag = trim($tag);

                  if (Str::length(Str::slug($tag))) {
                     $tagName = Str::slug($tag);

                     $tagCheck = Tag::where('tag_name', $tagName);

                     if ($tagCheck->count() == 0) {
                        $tagInfo = Tag::create(array(
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

         return Redirect::route('qa.create')
            ->with('success','Your question has been created successfully! '.HTML::linkRoute(
                  'qa.show', 'Click here to see your question',array(
                  'id'=> $questionId,'title'=>Str::slug($question->title)
               )));

      } else {
         return Redirect::back()
            ->withInput()
            ->withErrors($validation);
      }
	}

	public function show($id, $title)
	{
		$question = Question::with('users', 'tags')->find($id);

      if ($question) {
         $question->update(array(
            'viewed' => $question->viewed + 1
         ));

         return $this->layout->content = View::make('qa.show')
            ->with('title', $question->title)
            ->with('question', $question);
      } else {
         return Redirect::route('qa.index')
            ->with('error', 'Question was not found!');
      }
	}

	public function edit($id)
	{
		//
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		$question = Question::find($id);

      if ($question) {
         $question->delete();

         return Redirect::route('qa.index')
            ->with('success', 'Question deleted successfully!');
      } else {
         return Redirect::back()
            ->with('error', 'Nothing to delete!');
      }
	}

}