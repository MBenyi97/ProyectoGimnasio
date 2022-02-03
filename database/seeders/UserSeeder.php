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
            'dni' => '12345678Q',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'weight' => '75',
            'height' => '180',
            'birthdate' => '1995-06-15 00:00:00',
            'gender' => 'Man',
            'password' => Hash::make('adminadmin'),
        ]);
    }
}
