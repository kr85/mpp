<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEppsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('epps', function(Blueprint $table)
      {
         $table->increments('id');

         $table->integer('user_id')->unsigned()->default(0);
         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

         $table->integer('performance_index')->nullable()->default(0);

         $table->integer('explosive_power_id')->unsigned()->default(0);
         $table->foreign('explosive_power_id')->references('id')->on('explosive_power')->onDelete('cascade');

         $table->integer('aerobic_fitness_id')->unsigned()->default(0);
         $table->foreign('aerobic_fitness_id')->references('id')->on('aerobic_fitness')->onDelete('cascade');

         $table->integer('anaerobic_fitness_id')->unsigned()->default(0);
         $table->foreign('anaerobic_fitness_id')->references('id')->on('anaerobic_fitness')->onDelete('cascade');

         $table->integer('maximum_strength_id')->unsigned()->default(0);
         $table->foreign('maximum_strength_id')->references('id')->on('maximum_strength')->onDelete('cascade');

         $table->integer('muscular_endurance_id')->unsigned()->default(0);
         $table->foreign('muscular_endurance_id')->references('id')->on('muscular_endurance')->onDelete('cascade');

         $table->timestamps();
      });
   }


   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::drop('epps');
   }

}