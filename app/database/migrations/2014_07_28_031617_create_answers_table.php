<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function(Blueprint $table)
		{
			$table->increments('id');
         $table->unsignedInteger('question_id')->default(0);
         $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
         $table->unsignedInteger('user_id')->default(0);
         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->text('answer');
         $table->enum('correct', array('0', '1'))->default(0);
         $table->integer('votes')->default(0);
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
		Schema::drop('answers');
	}

}
