<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

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
            'activity' => 'Boxeo',
            'description' => 'Clase de boxeo',
            'duration' => '25',
            'capacity' => '15'
        ]);
    }
}
