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
		//
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

      } else {
         return Redirect::back()
            ->withInput()
            ->withErrors($validation);
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

	public function destroy($id)
	{
		//
	}

}