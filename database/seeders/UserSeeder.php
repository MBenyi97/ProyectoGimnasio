<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'dni' => '12345678Q',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'weight' => '75',
            'height' => '180',
            'birthdate' => '1995-06-15 00:00:00',
            'gender' => 'Hombre',
            'password' => Hash::make('adminadmin'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'dni' => '12345679B',
            'name' => 'Enrique',
            'email' => 'enrique@gmail.com',
            'weight' => '80',
            'height' => '175',
            'birthdate' => '2000-12-06 00:00:00',
            'gender' => 'Hombre',
            'password' => Hash::make('usuariousuario'),
        ]);

        DB::table('users')->insert([
            'role_id' => '3',
            'dni' => '87654321A',
            'name' => 'Amador',
            'email' => 'amador@gmail.com',
            'weight' => '84',
            'height' => '183',
            'birthdate' => '1989-05-27 00:00:00',
            'gender' => 'Hombre',
            'password' => Hash::make('usuariousuario'),
        ]);
    }
}
