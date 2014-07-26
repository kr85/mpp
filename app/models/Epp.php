<?php

class Epp extends \Eloquent
{

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

   public function getExplosivePowerId()
   {
      return $this->explosive_power_id;
   }

   public function getAerobicFitnessId()
   {
      return $this->aerobic_fitness_id;
   }



}