<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'weekDay' => 'Viernes',
            'date' => '2022-02-25',
            'hour_start' => '18:00',
            'hour_end' => '19:00',
            'activity_id' => '1'
        ]);
        DB::table('sesions')->insert([
            'weekDay' => 'Jueves',
            'date' => '2022-02-03',
            'hour_start' => '21:00',
            'hour_end' => '22:00',
            'activity_id' => '1'
        ]);
        DB::table('sesions')->insert([
            'weekDay' => 'Sábado',
            'date' => '2022-02-12',
            'hour_start' => '12:00',
            'hour_end' => '13:00',
            'activity_id' => '1'
        ]);
    }
}
