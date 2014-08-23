<?php namespace MPP\Validation\Question;

use MPP\Validation\LaravelValidator;
use MPP\Validation\ValidationInterface;

/**
 * Class QuestionFormValidator
 *
 * @package MPP\Validation\Question
 */
class QuestionFormValidator extends LaravelValidator implements ValidationInterface
{
   /**
    * Validation for asking a new question.
    *
    * @var array
    */
   protected $rules = array(
      'title'    => 'required|min:3',
      'question' => 'required|min:10'
   );
}
