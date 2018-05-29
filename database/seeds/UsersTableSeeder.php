<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = [
            [
                'name' => 'gast',
                'email' => 'gast@gast.nl',
                'password' => Hash::make('password'),
                'verified' => 1,
            ],
            [
                'name' => 'Susanne Meeuwissen',
                'email' => 'susanne@embav.nl',
                'password' => Hash::make('password'),
                'verified' => 1,
            ],
            [
                'name' => 'Maarten de Jager',
                'email' => 'maartendejager@gmail.com',
                'password' => Hash::make('password'),
                'verified' => 1,
            ],
            [
                'name' => 'admin',
                'email' => 'admin@temp.com',
                'password' => Hash::make('password'),
                'verified' => 1,
            ],
            [
                'name' => 'guest',
                'email' => 'guest@guest.com',
                'password' => Hash::make('guest'),
                'verified' => 1,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
