<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            'dni' => '55353291Q',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'weight' => '75',
            'height' => '180',
            'birthdate' => '1995-06-15 00:00:00',
            'gender' => 'Hombre',
            'password' => Hash::make('adminadmin'),
        ]);

        DB::table('users')->insert([
            'role_id' => '1',
            'dni' => '31637561Q',
            'name' => 'Ester',
            'email' => 'ester@gmail.com',
            'weight' => '65',
            'height' => '174',
            'birthdate' => '1990-06-15 00:00:00',
            'gender' => 'Mujer',
            'password' => Hash::make('adminadmin'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'dni' => '45588190A',
            'name' => 'Raquel',
            'email' => 'raquel@gmail.com',
            'weight' => '61',
            'height' => '163',
            'birthdate' => '1983-10-12 00:00:00',
            'gender' => 'Mujer',
            'password' => Hash::make('useruser'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'dni' => '29150983B',
            'name' => 'Enrique',
            'email' => 'enrique@gmail.com',
            'weight' => '80',
            'height' => '175',
            'birthdate' => '2000-12-06 00:00:00',
            'gender' => 'Hombre',
            'password' => Hash::make('useruser'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
<<<<<<< HEAD
            'dni' => '87654321A',
=======
            'dni' => '87880821A',
>>>>>>> 78a5c8abac5599f7273aa3d316b5a6cc6cdaab49
            'name' => 'Amador',
            'email' => 'amador@gmail.com',
            'weight' => '84',
            'height' => '183',
            'birthdate' => '1989-05-27 00:00:00',
            'gender' => 'Hombre',
            'password' => Hash::make('useruser'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'dni' => '84302599B',
            'name' => 'Judith',
            'email' => 'judith@gmail.com',
            'weight' => '64',
            'height' => '176',
            'birthdate' => '1984-07-02 00:00:00',
            'gender' => 'Mujer',
            'password' => Hash::make('useruser'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'dni' => '848419A',
            'name' => 'Fermin',
            'email' => 'fermin@gmail.com',
            'weight' => '78',
            'height' => '172',
            'birthdate' => '1979-09-15 00:00:00',
            'gender' => 'Hombre',
            'password' => Hash::make('useruser'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'dni' => '5725591B',
            'name' => 'Nines',
            'email' => 'nines@gmail.com',
            'weight' => '58',
            'height' => '158',
            'birthdate' => '1984-07-02 00:00:00',
            'gender' => 'Mujer',
            'password' => Hash::make('useruser'),
        ]);
    }
}
