<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            'user_id' => '1',
            'sesion_id' => '1',
            'date' => '2022-02-25 19:00:00'
        ]);
    }
}
