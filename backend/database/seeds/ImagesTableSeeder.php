<?php

use App\Image;
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
		    DB::table('images')->insert([
		        'image_path'=> $faker->image($dir = 'storage/app/public', $width = 640, $height = 480, $category = null, $fullPath = false),
		    ]);
		}        
    }
}
