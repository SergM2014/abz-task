<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePositionRequest;
use App\Http\Requests\CreatePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\PositionInterface;
use App\Interfaces\EmployeeInterface;

class PositionController extends Controller
{
    public function __construct(
        private EmployeeInterface $employeeRepository,
        private PositionInterface $positionRepository 
        ) {}

    public function index()
    {
        return view('admin.positions.index');
    }

    public function create(): View
    {
        $subordinaryLevels = $this->positionRepository->getSubordinaryLevels();

        return view('admin.positions.create', ['subordinaryLevels' => $subordinaryLevels]);
    }

    public function store(CreatePositionRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->positionRepository->store($request, $validated);

        return redirect()->route('positions.index')->with('success','A new position is created!');
    }

    public function edit($id): View
    {
        $subordinaryLevels = $this->positionRepository->getSubordinaryLevels();
        $position = $this->positionRepository->getById($id);
        $subordinaryLevel = old('subordinaryLevel')?? $position->subordinary_level;

        return view('admin.positions.update', [
            'position' => $position,
            'subordinaryLevels' => $subordinaryLevels,
            'subordinaryLevel' => $subordinaryLevel,
            ]);
    }

    public function update(UpdatePositionRequest $request, $id): RedirectResponse
    {
        $validated = $request->validated();
        $this->positionRepository->update($request, $validated, $id);

        return redirect()->route('positions.index')->with('success','the position'.$id.' was updated!');
    }

    public function destroy($id): JsonResponse
    {
        return response()->json([
            'message' => 'The Position#'.request('id').' is deleted', 
            'success' => true
        ]);
    }

    public function getSupremePositions(Request $request): array
    {
        $supremeLevelId = ((integer)request('subordinaryLevel'))-1;
        if (!$supremeLevelId) {
            return ['results'=> [['id' => 0, 'text' => 'it is the highest hierachical level! No suprem positions at all!']]];
        }
        $positions = $this->positionRepository->getPositionsBySupremeLevelId($supremeLevelId);

        return ['results' => $positions];
    }

    public function getSubPositions():JsonResponse
    {    
        if (count($this->positionRepository->getSubPositions())) {
            return response()->json([
                'message' => 'Attention! Position has  subposition(s)', 
                'success' => false
            ]);
        }

        return response()->json([
            'message' => 'Are You shure to delete the Position#'.request('id').'?', 
            'success' => true
        ]);
    }

    public function getEmployees(): JsonResponse
    {
        if(count($this->employeeRepository->getEmployeesByPositionId())) {
            return response()->json([
                'message' => 'Attention! Position has employee(s)', 
                'success' => false
            ]);
        }

        return response()->json([
            'message' => 'Are You shure to delete the Position#'.request('id').'?', 
            'success' => true
        ]);
    }

    public function delete(): RedirectResponse
    { 
        return redirect()->route('positions.index')
        ->with('success','The position#'.request('id').' was deleted!');  
    }

    public function preprocess(): View
    {
        $position = $this->positionRepository->getById(request('id'));

        $employeesNumber = count($this->employeeRepository->getEmployeesByPositionId());

        $siblingsPositions = $this->positionRepository->getSiblingsPosition($position->subordinary_level);

        $subOrdinaryLevel = ($position->subordinary_level)+1;
 
        $subPositionsNumber = count ($this->positionRepository->getPositionsBySubLevelAndId($subOrdinaryLevel));   
                            
        extract($this->getVariablesForView($employeesNumber, $subPositionsNumber));

        return view('admin.positions.preprocess', [
            'route' => $route,
            'submitBtnTitle' => $submitBtnTitle,
            'selectTitle' => $selectTitle,
            'disclaimer' => $disclaimer,
            'position' => $position, 
            'siblingsPositions' => $siblingsPositions,
             ] );
    }

    public function resubordinateEmployees(ChangePositionRequest $request): RedirectResponse
    {
        $validated = $request->validated();
       
        $this->employeeRepository->changePosition();

        return redirect()->route('positions.index')
        ->with('success','The Position#'.request('id').' was deleted! All it employees were were resubordinated to Position#'.request('siblingsPosition')); 
    }

    public function changeSiblings(ChangePositionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->positionRepository->changeUpperPosition();

        return redirect()->route('positions.index')
        ->with('success','The Position#'.request('id').' was deleted! All it subposition were were resubordinated to Position#'.request('siblingsPosition')); 
    }

    public function rearange(ChangePositionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->employeeRepository->changePosition();
        $this->positionRepository->changeUpperPosition();
     
        return redirect()->route('positions.index')
        ->with('success','The Position#'.request('id').' was deleted! All it subposition(s) and employee(s) were were resubordinated to Position#'.request('siblingsPosition')); 
    }

    private function getVariablesForView($employeesNumber, $subPositionsNumber): array
    {
        if(request('employees')) {
            $route = route('positions.employees.resubordinate');
            $disclaimer = "The current Position contains  $employeesNumber  employee(s).";
            $selectTitle = "Choose another position to resubordinate employee(s)";
            $submitBtnTitle = "Resubordinate employees and delete current position";  
        }
        if(request('subpositions')) {
            $route = route('positions.siblings.change');
            $disclaimer = "The current Position contains  $subPositionsNumber subposition(s)";
            $selectTitle = "Change for another siblings position to resubordinate subposition(s)";
            $submitBtnTitle = "Choose sibling position and delete the current one";  
        }
        if(request('subpositions') AND request('employees')) {
            $route = route('positions.rearange');
            $disclaimer = "The current Position contains  $subPositionsNumber subposition(s) and  $employeesNumber  employee(s).";
            $submitBtnTitle = "Change for another sibling position and to resubordinate employee(s) and delete the current Position";
            $selectTitle = "Change for another siblings position to resubordinate subposition(s) and employee(s)";  
        }

        return compact('route', 'disclaimer', 'submitBtnTitle', 'selectTitle');
    }
}
