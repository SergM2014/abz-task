<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::all('id', 'title');
        //the under line must be corrected later
        $photo = \old('photo')?? 'no-avatar.png';
       
        return view('admin.employees.create', ['positions' => $positions, 'photo' => $photo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {

        $validated = $request->validated();

        $employee = new Employee();
        $employee-> first_name = $validated['firstName'];
        $employee-> middle_name = $validated['middleName']? : null;
        $employee-> last_name = $validated['lastName'];
        $employee->position_id = $validated['positionId'];
        $employee->leader_id = $validated['leaderId'];
        $employee->employment_date = $validated['employmentDate'];
        $employee->phone = $validated['phone'];
        $employee->email = $validated['email'];
        $employee->salary = $validated['salary'];
        $employee->photo = request('photo')? : null;
        $employee->admin_created_id = 1;

        $employee->save();

        dd('saved! Hurra!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employees.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $employees = Employee::where('last_name', 'LIKE', '%'.$request->input('term', '').'%')
                    ->get(['id', DB::raw("CONCAT(first_name, ' ', middle_name ,' ', last_name) as text")]);

        return ['results' => $employees];
      
    }
}
