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
        Employee::factory()->count(1000)->teamLeader()->create();
        Employee::factory()->count(5000)->supervisor()->create();
        Employee::factory()->count(45000)->employee()->create();
    }
}
