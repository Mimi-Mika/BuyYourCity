<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    	$faker = \Faker\Factory::create();
    	//Create admin
        DB::table('users')->insert([
            'name' => 'adminbyc',
            'email' => 'adminbyc@gmail.com',
            'password' => bcrypt('adminbyc'),
            'pointsAvailable'=> 0,
            'ban'=>0,
            'validEmail'=>1,
            'admin'=>1,
            'image_id' => 1,
            'api_token'=> str_random(60),
        ]);

		for ($i=0; $i < 9; $i++) { 
			$str_login = $faker->unique()->userName;
		    DB::table('users')->insert([
		        'name' => $str_login,
		        'email' => $str_login.'@gmail.com',
		        'password' => bcrypt($str_login),
		        'pointsAvailable'=>$faker->numberBetween($min = 30, $max = 500),
		        'ban'=>$faker->boolean,
		        'validEmail'=>$faker->boolean,
                'admin'=>1,
                'image_id' => $faker->numberBetween($min = 1, $max = 10),
                'api_token'=> str_random(60),
            ]);
		}
    }
}