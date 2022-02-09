<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'administrador',
            'created_at' => Carbon::now()
        ]);
        DB::table('roles')->insert([
            'name' => 'usuario',
            'created_at' => Carbon::now()
        ]);
        DB::table('roles')->insert([
            'name' => 'registrado',
            'created_at' => Carbon::now()
        ]);
    }
}
