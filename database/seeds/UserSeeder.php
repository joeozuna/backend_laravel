<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Alvaro',
            'last_name' => 'Ozuna',
            'address' => 'Itagui Antioquia',
            'phone_number' => '+573126316228',
            'email' =>  'ajom43@gmail.com',
            'email_verified_at' =>  'ajom43@gmail.com',
            'password' =>  Hash::make('123456'),
        ]);
    }
}
