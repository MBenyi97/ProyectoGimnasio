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
            // 'name' => '1',
            'fechaSesion' => '1995-06-15 00:00:00',
            'horaInicio' => '1995-06-15 00:00:00',
            'horaFinal' => '1995-06-15 00:00:00'
        ]);
    }
}
