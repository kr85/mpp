<?php namespace MPP\Validation;

interface ValidationInterface
{
   public function passes();

   public function errors();

   public function with(array $input);
}