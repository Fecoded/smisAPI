<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert(array(array(
            'id' => 'f3aa4117-849b-4310-b921-234aa33d2021',
            'name' => 'Kindergarten',
            'schoolName' => 'Royalty Academics',
            'description' => 'This is a kindergarten for little children',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ), array(
            'id' => '48e969c7-3b5e-4d7f-9c27-808dfd9acc74',
            'name' => 'Montessories',
            'schoolName' => 'Royalty Academics',
            'description' => 'This is a Montessories for little children',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ), array(
            'id' => '48e969c7-3b5e-4d7f-9c27-808dfd9abb65',
            'name' => 'Nursery',
            'schoolName' => 'Royalty Academics',
            'description' => 'This is a Nursery for little children',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ), array(
             'id' => '48e969c7-3b5e-4d7f-9c27-808dfd9aef54',
            'name' => 'Primary',
            'schoolName' => 'Royalty Academics',
            'description' => 'This is a Primary for little children',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        )
    ));
    }
}
