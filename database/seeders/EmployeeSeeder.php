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
        Employee::factory()->count(5) ->viceDirector()->create();
        Employee::factory()->count(10)->teamLeader()->create();
        Employee::factory()->count(20)->supervisor()->create();
        Employee::factory()->count(40)->employee()->create();
    }
}
