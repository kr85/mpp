<?php namespace MPP\Form\Answer;

use MPP\Validation\LaravelValidator;
use MPP\Validation\ValidationInterface;

/**
 * Class AnswerFormValidator
 *
 * @package MPP\Form\Answer
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