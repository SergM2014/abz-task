<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\UpdateLeaderRequest;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employees.index');
    }

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
        $employee->admin_created_id = $request->user()->id;
        $employee->save();
       
        return redirect()->route('employees.index')->with('success','A new employee is created!');
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
        $positions = Position::all('id', 'title');
        $photo =  \old('photo')?? $employee->photo ?? 'no-avatar.png';
        $positionId = \old('positionId')?? $employee->position_id;
        return view('admin.employees.edit', [
            'employee' => $employee, 
            'positions' => $positions, 
            'photo' => $photo,
            'positionId' => $positionId
        ]);
    }

    
    public function update(UpdateEmployeeRequest $request, $id)
  
    {
        $validated = $request->validated();

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

        return redirect()->route('employees.index')->with('success','the employee#'.$id.' is updated!');
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

    public function search(Request $request): array
    {
        $superiorId = $this->getSuperiorsPositionId(request('positionId'));

        $employees = Employee::where('last_name', 'LIKE', '%'.$request->input('term', '').'%')
                    ->where('position_id', $superiorId)
                    ->get(['id', DB::raw("CONCAT(first_name, ' ', middle_name ,' ', last_name) as text")]);

        return ['results' => $employees];
    }

    public function getLeader(Request $request): JsonResponse
    {
        if (!request('leaderId')) {
            return response()->json(['id' => 0, 'text' => 'it is the highest hierachical level! No suprem positions at all!']);
        }

        $leader = Employee::where('id', request('leaderId'))
                ->first(['id', DB::raw("CONCAT(first_name, ' ', middle_name ,' ', last_name) as text")]);

         return response()->json(['id' => $leader->id, 'text' => $leader->text]);
       
    }

    private function getSuperiorsPositionId(int $id): int
    {
        $position = Position::find($id);
        $parentId = $position->parent_id;
        
       return $parentId; 
    }

    public function getSubordinates( $id = null): Collection
    {
        $id = $id?? request('id');
        $subOrdinates = Employee::where('leader_id', $id)->get();

        return $subOrdinates;
    }

    public function getLeaderToChange(): View
    {
        $leader = Employee::find(request('id'));

        $siblingsNumber =  count(Employee::where('position_id', $leader->position_id)
                            ->whereNot('id',  $leader->id)
                            ->get() );

        $subOrdinates = $this->getSubordinates();

        return view('admin.employees.changeLeader', ['leader' => $leader, 'subOrdinates' => $subOrdinates, 'siblingsNumber' => $siblingsNumber]);
    }

    public function searchLeaders(Request $request)
    {
        $employees = Employee::where('last_name', 'LIKE', '%'.$request->input('term', '').'%')
                    ->where('position_id', $request->input('positionId'))
                    ->whereNot('id',  $request->input('id'))
                    ->get(['id', DB::raw("CONCAT(first_name, ' ', middle_name ,' ', last_name) as text")]);

        return ['results' => $employees];
    }

    public function changeLeader(UpdateLeaderRequest $request)
    {
        $subOrdinates = $this->getSubordinates(request('oldLeaderId'));
        
        foreach($subOrdinates as $subOrdinate) {
            $subOrdinate->leader_id = request('leaderId');
            $subOrdinate->update();
        }
       
    }

    
}
