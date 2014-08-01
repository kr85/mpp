<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions_tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('question_id')->default(0);
			$table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
			$table->unsignedInteger('tag_id')->default(0);
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
		Schema::drop('questions_tags');
	}

}
