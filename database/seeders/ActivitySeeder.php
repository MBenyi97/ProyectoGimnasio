<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->insert([
            'name' => 'Boxeo',
            'description' => 'Clase de boxeo',
            'duration' => '25',
            'capacity' => '15'
        ]);

        DB::table('activities')->insert([
            'name' => 'Step',
            'description' => 'Subir y bajas escalones',
            'duration' => '50',
            'capacity' => '35'
        ]);

        DB::table('activities')->insert([
            'name' => 'Gap',
            'description' => 'Gluteos, abdominales y piernas',
            'duration' => '45',
            'capacity' => '40'
        ]);

        DB::table('activities')->insert([
            'name' => 'GBody',
            'description' => 'Ejercitar el cuerpo',
            'duration' => '30',
            'capacity' => '35'
        ]);

        DB::table('activities')->insert([
            'name' => 'Natación',
            'description' => 'Sesión de natación en la piscina cubierta',
            'duration' => '50',
            'capacity' => '15'
        ]);

        DB::table('activities')->insert([
            'name' => 'Spinning',
            'description' => 'Cardio con bicicletas estáticas',
            'duration' => '55',
            'capacity' => '50'
        ]);
    }
}
