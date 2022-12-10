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
        Employee::factory()->count(100) ->viceDirector()->create();
        Employee::factory()->count(3000)->teamLeader()->create();
        Employee::factory()->count(10000)->supervisor()->create();
        Employee::factory()->count(50000)->employee()->create();
    }
}
