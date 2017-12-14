<?php

use App\Place;
use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Place::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    	$faker = \Faker\Factory::create();
		for ($i=0; $i < 10; $i++) {
			$pointsGiven = $faker->numberBetween($min = 1, $max = 10);
			//$str_login = $faker->userName;
		    DB::table('places')->insert([
		        'name' => $faker->unique()->state.' '.$faker->unique()->city,
		        'latitude' =>  $faker->latitude($min = -90, $max = 90),
		        'longitude' => $faker->longitude($min = -90, $max = 90),
		        'pointsGiven'=> $pointsGiven,
		        'pointsCost'=> $pointsGiven*10,
		        'image_id'=> $pointsGiven,
		        'user_id'=> $faker->numberBetween($min = 1, $max = 10)
		    ]);
		}
    }
}