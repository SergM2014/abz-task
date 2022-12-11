<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeInterface
{
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

    public function getById(int $id): Employee
    {
        return Employee::findOrFail($id);
    }

    public function update(Request $request, array $validated, int $id): void
    {
        $employee = Employee::find($id);
        $employee-> first_name = $validated['firstName'];
        $employee-> middle_name = $validated['middleName']?? null;
        $employee-> last_name = $validated['lastName'];
        $employee->position_id = $validated['positionId'];
        $employee->leader_id = $validated['leaderId'];
        $employee->employment_date = $validated['employmentDate'];
        $employee->phone = $validated['phone'];
        $employee->email = $validated['email'];
        $employee->salary = $validated['salary'];
        $employee->photo = request('photo')? : null;
        $employee->admin_updated_id = $request->user()->id;
        $employee->save();
    }
}