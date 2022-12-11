<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\Position;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeInterface
{
    public function getAllPositions(): Collection
    {
        return Position::all('id', 'title');
    }

    public function store(Request $request, array $validated): void
    {
        $employee = new Employee();
        $employee->first_name = $validated['firstName'];
        $employee->middle_name = $validated['middleName'];
        $employee->last_name = $validated['lastName'];
        $employee->position_id = $validated['positionId'];
        $employee->leader_id = $validated['leaderId'];
        $employee->employment_date = $validated['employmentDate'];
        $employee->phone = $validated['phone'];
        $employee->email = $validated['email'];
        $employee->salary = $validated['salary'];
        $employee->photo = request('photo')? : null;
        $employee->admin_created_id = $request->user()->id;
        $employee->save();
    }
}