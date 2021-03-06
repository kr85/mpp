<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions_votes', function(Blueprint $table)
		{
			$table->increments('id');
         $table->unsignedInteger('user_id')->default(0);
         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->unsignedInteger('question_id')->default(0);
         $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
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
		Schema::drop('questions_votes');
	}

}
