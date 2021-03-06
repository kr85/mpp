<?php namespace MPP\Validation\Answer;

use MPP\Validation\LaravelValidator;
use MPP\Validation\ValidationInterface;

/**
 * Class AnswerFormValidator
 *
 * @package MPP\Validation\Answer
 */
class AnswerFormValidator extends LaravelValidator implements ValidationInterface
{
   /**
    * Validation for answering a question.
    *
    * @var array
    */
   protected $rules = array(
      'answer' => 'required|min:2'
   );
}
