<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\UpdateLeaderRequest;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\PositionInterface;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function __construct(
        private EmployeeInterface $employeeRepository,
        private PositionInterface $positionRepository
        ) {}

    public function index(): View
    {
        return view('admin.employees.index');
    }

    public function create(): View
    {
        $positions = $this->positionRepository->getAll();
       
        return view('admin.employees.create', ['positions' => $positions]);
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->employeeRepository->store($request, $validated);
       
        return redirect()->route('employees.index')->with('success','A new employee is created!');
    }

    public function edit($id): View
    {
        $employee = $this->employeeRepository->getById($id);
        $positions = $this->positionRepository->getAll();
        $positionId = \old('positionId')?? $employee->position_id;
        return view('admin.employees.edit', [
            'employee' => $employee, 
            'positions' => $positions, 
            'positionId' => $positionId
        ]);
    }
   
    public function update(UpdateEmployeeRequest $request, $id): RedirectResponse
    {
        $validated = $request->validated();

        $this->employeeRepository->update($request, $validated, $id);

        return redirect()->route('employees.index')->with('success','the employee#'.$id.' is updated!');
    }

    public function search(Request $request): array
    {
        $superiorId = $this->getSuperiorsPositionId(request('positionId'));

        if (!$superiorId) {
            return [
                'results' => [
                               [ 'id' => 0, 'text' => 'This is superior Position, no leader possible!' ]
                             ]
                    ];
        }

        $employees = $this->employeeRepository->search($request, $superiorId);

        return ['results' => $employees];
    }

    public function getLeader(Request $request): JsonResponse
    {
        if (!request('leaderId')) {
            return response()->json(['id' => 0, 'text' => 'it is the highest hierachical level! No suprem positions at all!']);
        }

        // $leader = Employee::where('id', request('leaderId'))
        //         ->first(['id', DB::raw("CONCAT(first_name, ' ', middle_name ,' ', last_name) as text")]);
        $leader = $this->employeeRepository->getLeader();
        
         return response()->json(['id' => $leader->id, 'text' => $leader->text]);
    }

    private function getSuperiorsPositionId(int $id): ?int
    {
        $position = $this->positionRepository->getById($id);
        $parentId = $position->parent_id;
        
       return $parentId; 
    }

    public function getSubordinates( $id = null): Collection
    {
        $id = $id?? request('id');
        $subOrdinates = Employee::where('leader_id', $id)->get();

        return $subOrdinates;
    }

    public function getLeaderToChange(): View|RedirectResponse
    {
        $subOrdinates = $this->getSubordinates();

        if(count($subOrdinates) < 1) {
            Employee::destroy(request('oldLeaderId'));
            return redirect()->route('employees.index')->with('success','The employee#'.request('id').' was deleted!'); 
        }

        $leader = Employee::with('position')->find(request('id'));

        $siblingsNumber =  count(Employee::where('position_id', $leader->position_id)
                            ->whereNot('id',  $leader->id)
                            ->get() );

        return view('admin.employees.changeLeader', ['leader' => $leader, 'subOrdinates' => $subOrdinates, 'siblingsNumber' => $siblingsNumber]);
    }

    public function searchLeaders(Request $request): array
    {
        $employees = Employee::where('last_name', 'LIKE', '%'.$request->input('term', '').'%')
                    ->where('position_id', $request->input('positionId'))
                    ->whereNot('id',  $request->input('id'))
                    ->get(['id', DB::raw("CONCAT(first_name, ' ', middle_name ,' ', last_name) as text")]);

        return ['results' => $employees];
    }

    public function changeLeader(UpdateLeaderRequest $request): RedirectResponse
    {
        DB::table('employees')->where('leader_id', request('oldLeaderId'))->update(['leader_id' => request('leaderId')]);
        
        Employee::destroy(request('oldLeaderId'));
       
        return redirect()->route('employees.index')->with('success','The employee#'.request('oldLeaderId').' was deleted!');
    }

    public function destroy($id): JsonResponse
    {
        Employee::destroy(request('id'));
        
        return response()->json([
            'message' => 'The Employee#'.request('id').' is deleted', 
            'success' => true
        ]);
    }

    public function delete(): RedirectResponse
    { 
        return redirect()->route('employees.index')->with('success','The employee#'.request('id').' was deleted!');
    }
}
