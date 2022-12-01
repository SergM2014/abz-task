<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            'qualification_code' => '257434654753006',
            'title' => 'director',
            'description' => 'It is a main person in firm. + additional some dummy text',
            'created_at' => now()
        ]);
        DB::table('positions')->insert([
            'qualification_code' => '257434243753007',
            'title' => 'vice-director',
            'description' => 'It is the very importent person in firm. + additional some dummy text',
            'created_at' => now()
        ]);
        DB::table('positions')->insert([
            'qualification_code' => '257434654753008',
            'title' => 'team leader',
            'description' => 'It is a middle person in firm. + additional some dummy text',
            'created_at' => now()
        ]);
        DB::table('positions')->insert([
            'qualification_code' => '257434654753009',
            'title' => 'supervisor',
            'description' => 'It is a small chief in firm. + additional some dummy text',
            'created_at' => now()
        ]);
        DB::table('positions')->insert([
            'qualification_code' => '257434654753010',
            'title' => 'employee',
            'description' => 'It is a ordinary person in firm. + additional some dummy text',
            'created_at' => now()
        ]);
   
    }
}
