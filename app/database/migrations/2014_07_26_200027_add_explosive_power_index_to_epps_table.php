<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddExplosivePowerIndexToEppsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('epps', function(Blueprint $table)
		{
         $table->unsignedInteger('explosive_power_index')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('epps', function(Blueprint $table)
		{
         //$table->dropColumn('explosive_power_index');
		});
	}

}
