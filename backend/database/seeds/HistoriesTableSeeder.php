<?php

use App\History;
use Illuminate\Database\Seeder;

class HistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        History::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $faker = \Faker\Factory::create();
		for ($i=0; $i < 10; $i++) {
    		$buySell = $faker->boolean;
            \Log::info($buySell);
		    DB::table('histories')->insert([
		        'buySell' => $buySell == 1 ? 'buy' : 'sell',
		        'user_id' =>  $faker->numberBetween($min = 1, $max = 10),
		        'place_id' => $faker->numberBetween($min = 1, $max = 10),
		    ]);
		}
    }
}