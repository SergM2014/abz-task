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
            'title' => 'director',
            'description' => 'It is a main person in firm. + additional some dummy text',
            'created_at' => now()
        ]);
        DB::table('positions')->insert([
            'title' => 'vice-director',
            'description' => 'It is the very importent person in firm. + additional some dummy text',
            'parent_id'=> 1,
            'created_at' => now()
        ]);
        DB::table('positions')->insert([
            'title' => 'team leader',
            'description' => 'It is a middle person in firm. + additional some dummy text',
            'parent_id' => 2,
            'created_at' => now()
        ]);
        DB::table('positions')->insert([
            'title' => 'supervisor',
            'description' => 'It is a small chief in firm. + additional some dummy text',
            'parent_id' => 3,
            'created_at' => now()
        ]);
        DB::table('positions')->insert([
            'title' => 'employee',
            'description' => 'It is a ordinary person in firm. + additional some dummy text',
            'parent_id' => 4,
            'created_at' => now()
        ]);
   
    }
}
