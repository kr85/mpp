<?php namespace MPP\Form;

/**
 * Class AbstractForm
 *
 * @package MPP\Form
 */
abstract class AbstractForm
{
   /**
    * Repository.
    *
    * @var
    */
   protected $repository;

   /**
    * Validator.
    *
    * @var
    */
   protected $validator;

   /**
    * Save the form if valid.
    *
    * @param array $input
    * @return bool|mixed
    */
   public function save(array $input)
   {
      if (!$this->valid($input)) {
         return false;
      }

      return $this->repository->create($input);
   }

   /**
    * Update the form if valid.
    *
    * @param $id
    * @param array $input
    * @return bool
    */
   public function update($id, array $input)
   {
      if (!$this->valid($input)) {
         return false;
      }

      return $this->repository->update($id, $input);
   }

   /**
    * Return validation errors.
    *
    * @return mixed
    */
   public function errors()
   {
      return $this->validator->errors();
   }

   /**
    * Check if valid.
    *
    * @param array $input
    * @return mixed
    */
   protected function valid(array $input)
   {
      return $this->validator->with($input)->passes();
   }
}