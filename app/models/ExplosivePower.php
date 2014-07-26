<?php

class ExplosivePower extends \Eloquent
{
	protected $fillable = [];

   public function getExplosivePowerIndex()
   {
      return $this->explosive_power_index;
   }
}