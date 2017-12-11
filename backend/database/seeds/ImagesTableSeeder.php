<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Image::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    	$faker = \Faker\Factory::create();
		for ($i=0; $i < 10; $i++) {
			$pointsGiven = $faker->numberBetween($min = 1, $max = 10);
			//$str_login = $faker->userName;
		    DB::table('image')->insert([
		        'name' => $faker->unique()->state.' '.$faker->unique()->city,
		        'latitude' =>  $faker->latitude($min = -90, $max = 90),
		        'longitude' => $faker->longitude($min = -90, $max = 90),
		        'pointsGiven'=> $pointsGiven,
		        'pointsCost'=> $pointsGiven*10,
		        'pictPath'=> $faker->image($dir = 'storage/app/public/images', $width = 640, $height = 480),
		        'user_id'=> $faker->numberBetween($min = 1, $max = 10)
		    ]);
		}        
    }
}
