<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory()->create();
        Employee::factory()->count(20) ->viceDirector()->create();
        Employee::factory()->count(100)->teamLeader()->create();
        Employee::factory()->count(500)->supervisor()->create();
        Employee::factory()->count(4500)->employee()->create();
    }
}
