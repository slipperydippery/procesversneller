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
        $this->call(UsersTableSeeder::class);
        $this->call(ScanmodelsTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(InstantiesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
    }
}
