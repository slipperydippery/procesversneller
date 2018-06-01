<?php

use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->delete();

        $themes = [
            [
                'id' => '1',
                'title' => 'Focus op werk en talent',
                'short' => '',
                'body' => '',
                'scanmodel_id' => '1'
            ],
            [
                'id' => '2',
                'title' => 'Kwaliteit begeleiding',
                'short' => '',
                'body' => '',
                'scanmodel_id' => '1'
            ],
            [
                'id' => '3',
                'title' => 'Effectieve samenwerking',
                'short' => '',
                'body' => '',
                'scanmodel_id' => '1'
            ],
        ];

        DB::table('themes')->insert($themes);
    }
}
