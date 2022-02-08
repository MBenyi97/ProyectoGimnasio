<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
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
        DB::table('sesion_user')->insert([
            'user_id' => '1',
            'sesion_id' => '1',
            'created_at' => '2022-02-25 19:00:00'
        ]);
        DB::table('sesion_user')->insert([
            'user_id' => '1',
            'sesion_id' => '2',
            'created_at' => '2022-02-25 19:00:00'
        ]);
        DB::table('sesion_user')->insert([
            'user_id' => '1',
            'sesion_id' => '3',
            'created_at' => '2022-02-25 19:00:00'
        ]);
    }
}
