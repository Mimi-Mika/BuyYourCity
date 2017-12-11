<?php

use App\Parameter;
use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Parameter::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $faker = \Faker\Factory::create();
    	for ($i=0; $i < 5; $i++) {
		    DB::table('parameters')->insert([
		        'name' => 'config'.$faker->unique()->numberBetween($min = 0, $max = 10),
		        'perimeter' =>  $faker->unique()->numberBetween($min = 1, $max = 10),
		        'sellPercent' => $faker->numberBetween($min = 1, $max = 100),
		        'seeRadius'=> $faker->numberBetween($min = 10, $max = 100)
		    ]);
		}
    }
}