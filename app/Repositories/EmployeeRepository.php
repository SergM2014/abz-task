<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;

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

    public function search(Request $request, int $superiorId): SupportCollection
    {
        return Employee::where('last_name', 'LIKE', '%'.$request->input('term', '').'%')
                    ->where('position_id', $superiorId)
                    ->get(['id', DB::raw("CONCAT(first_name, ' ', middle_name ,' ', last_name) as text")]);
    }

    public function getLeader(): Employee
    {
        return  Employee::where('id', request('leaderId'))
        ->first(['id', DB::raw("CONCAT(first_name, ' ', middle_name ,' ', last_name) as text")]);
    }

    public function getSubordinates(int $id): Collection
    {
        return Employee::where('leader_id', $id)->get();
    }

    public function delete(): void
    {
        Employee::destroy(request('oldLeaderId'));
    }

    public function getLeaderWithPosition(): Employee
    {
        return Employee::with('position')->find(request('id'));
    }

    public function getSiblingsNumber($positionId, $leaderId): int
    {
        return count(Employee::where('position_id', $positionId)
        ->whereNot('id',  $leaderId)
        ->get() );
    }

    public function searchLeaders(Request $request): array
    {
       return Employee::where('last_name', 'LIKE', '%'.$request->input('term', '').'%')
                    ->where('position_id', $request->input('positionId'))
                    ->whereNot('id',  $request->input('id'))
                    ->get(['id', DB::raw("CONCAT(first_name, ' ', middle_name ,' ', last_name) as text")]);
    }

    public function changeLeader(): void
    {
        DB::table('employees')->where('leader_id', request('oldLeaderId'))->update(['leader_id' => request('leaderId')]);
    }

    public function deleteById(): void
    {
        Employee::destroy(request('id'));
    }
}