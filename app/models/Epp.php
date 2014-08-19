<?php

class Epp extends \Eloquent
{

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	protected $fillable = array();

   public function getExplosivePowerId()
   {
      return $this->explosive_power_id;
   }

   public function getAerobicFitnessId()
   {
      return $this->aerobic_fitness_id;
   }



}