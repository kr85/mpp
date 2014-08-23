<?php namespace MPP\Validation\Answer;

use MPP\Validation\LaravelValidator;
use MPP\Validation\ValidationInterface;

class AnswerFormValidator extends LaravelValidator implements ValidationInterface
{
   protected $rules = array(
      'answer' => 'required|min:2'
   );
}
