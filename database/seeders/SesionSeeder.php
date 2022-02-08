<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sesions')->insert([
            'date_start' => '2022-02-25 18:00:00',
            'date_end' => '2022-02-25 19:00:00',
            'activity_id' => '1'
        ]);
        DB::table('sesions')->insert([
            'date_start' => '2022-03-30 21:00:00',
            'date_end' => '2022-03-30 22:00:00',
            'activity_id' => '1'
        ]);
        DB::table('sesions')->insert([
            'date_start' => '2022-05-12 12:00:00',
            'date_end' => '2022-05-12 13:00:00',
            'activity_id' => '1'
        ]);
    }
}
