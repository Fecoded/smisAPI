<?php

namespace Database\Seeders;

use DateTime;
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
          DB::table('users')->insert(array(array(
            'id' => 'f3aa4117-849b-4310-b921-234aa33d9814',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'johndoe@gmail.com',
            // 'password' => Hash::make('password'),
            'password' => '$2a$10$B679aX.2Ba6LzWlZtMh5V.s1VDtkYssmy2imisfwaNXJX0GMgpWkm',
            'role' => 'super_admin',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
          ), array(
            'id' => '48e969c7-3b5e-4d7f-9c27-808dfd9abb74',
            'firstname' => 'Sam',
            'lastname' => 'Smith',
            'email' => 'samsmith@gmail.com',
            // 'password' => Hash::make('password'),
            'password' => '$2a$10$B679aX.2Ba6LzWlZtMh5V.s1VDtkYssmy2imisfwaNXJX0GMgpWkm',
            'role' => 'admin',
             'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
          ), array(
            'id' => '83b5c393-bcad-4132-b067-bbb01ef74a97',
            'firstname' => 'Toju',
            'lastname' => 'Nathaniel',
            'email' => 'tojuofe@gmail.com',
            // 'password' => Hash::make('password'),
            'password' => '$2a$10$B679aX.2Ba6LzWlZtMh5V.s1VDtkYssmy2imisfwaNXJX0GMgpWkm',
            'role' => 'user',
             'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
          ),
          ));
    }
}
