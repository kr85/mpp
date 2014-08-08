<?php

// Composer: "fzaninotto/faker": "v1.4.0"
//use Faker\Factory as Faker;

class VotesTableSeeder extends Seeder {

	public function run()
	{
      DB::table('votes')->delete();

      Vote::create(array('name' => 'like'));
      Vote::create(array('name' => 'unlike'));
	}

}
