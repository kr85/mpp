<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswersVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers_votes', function(Blueprint $table)
		{
			$table->increments('id');
         $table->unsignedInteger('user_id')->default(0);
         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->unsignedInteger('answer_id')->default(0);
         $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
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
		Schema::drop('answers_votes');
	}

}
