<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePositionRequest;
use App\Http\Requests\CreatePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PositionController extends Controller
{
    public function index()
    {
        return view('admin.positions.index');
    }

    public function create(): View
    {
        $subordinaryLevels = Position::groupBy('subordinary_level')->pluck('subordinary_level');
        return view('admin.positions.create', ['subordinaryLevels' => $subordinaryLevels]);
    }

    public function store(CreatePositionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $position = new Position;
        $position->subordinary_level = $validated['subordinaryLevel'];
        $position->title = $validated['title'];
        $position->description = $validated['description'];
        $position->parent_id = $validated['supremePositionIdSelect'];
        $position->admin_created_id = $request->user()->id;

        $position->save();

        return redirect()->route('positions.index')->with('success','A new position is created!');
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

    public function edit($id): View
    {
        $subordinaryLevels = Position::groupBy('subordinary_level')->pluck('subordinary_level');
        $position = Position::find($id);
        $subordinaryLevel = old('subordinaryLevel')?? $position->subordinary_level;
        $supremePositionIdSelect = old('supremePositionIdSelect')?? $position->parent_id;

        return view('admin.positions.update', [
            'position' => $position,
            'subordinaryLevels' => $subordinaryLevels,
            'subordinaryLevel' => $subordinaryLevel,
            'supremePositionIdSelect' => $supremePositionIdSelect 
            ]);
    }

    public function update(UpdatePositionRequest $request, $id): RedirectResponse
    {
        $validated = $request->validated();

        $position = Position::find($id);
        $position->subordinary_level = $validated['subordinaryLevel'];
        $position->title = $validated['title'];
        $position->description = $validated['description'];
        $position->parent_id =  $validated['supremePositionIdSelect'];
        $position->admin_updated_id = $request->user()->id;

        $position->save();

        return redirect()->route('positions.index')->with('success','the position'.$id.' was updated!');
    }

    public function destroy($id)//: RedirectResponse
    {
        //$destroyed = Employee::destroy(request('id'));
        
        return response()->json([
            'message' => 'AThe Position#'.request('id').' is deleted', 
            'success' => true
        ]);
    }

    public function getSupremePositions(Request $request): array
    {
        $supremeLevelId = ((integer)request('subordinaryLevel'))-1;
        if (!$supremeLevelId) {
            return ['results'=> [['id' => 0, 'text' => 'it is the highest hierachical level! No suprem positions at all!']]];
        }

        $positions = Position::where('subordinary_level', $supremeLevelId )
                ->get(['id', 'title as text']);

         return ['results' => $positions];
    }

    public function getSubPositions():JsonResponse
    {    
        //$positionNumber = count(Position::where('parent_id', request('id'))->first());

        if(Position::where('parent_id', request('id'))->first()) {
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

    public function getEmployees()
    {
        //$employeesNumber = count(Employee::where('position_id', request('id'))->first());

        if(Employee::where('position_id', request('id'))->first()) {
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
        $position = Position::find(request('id'));
        $employeesNumber = count(Employee::where('position_id', request('id'))->get()); 
        $siblingsPositions = Position::where('subordinary_level', $position->subordinary_level)
                            ->whereNot('id', $position->id)->get();
        return view('admin.positions.preprocess', ['position' => $position, 'employeesNumber' => $employeesNumber, 'siblingsPositions' => $siblingsPositions] );
    }

    public function resubordinateEmployees(ChangePositionRequest $request)
    {
        $validated = $request->validated();
       
    }
}
