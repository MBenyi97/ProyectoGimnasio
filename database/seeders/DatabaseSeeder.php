<?php

namespace Database\Seeders;

use  Database\Seeders\ActivitySeeder;
use  Database\Seeders\UserSeeder;
use  Database\Seeders\SesionSeeder;
use  Database\Seeders\ReservationSeeder;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(SesionSeeder::class);
        $this->call(ReservationSeeder::class);
    }
}
