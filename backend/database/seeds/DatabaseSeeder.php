<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ImagesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(ParametersTableSeeder::class);
        $this->call(HistoriesTableSeeder::class);
	}
}
