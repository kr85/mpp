<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddVoteIdToAnswersVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('answers_votes', function(Blueprint $table)
		{
         $table->unsignedInteger('vote_id')->default(0);
         $table->foreign('vote_id')->references('id')->on('votes')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('answers_votes', function(Blueprint $table)
		{
         $table->dropForeign('vote_id');
         $table->dropColumn('vote_id');
		});
	}

}
