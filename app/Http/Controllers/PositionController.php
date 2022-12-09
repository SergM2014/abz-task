<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.positions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $subordinaryLevels = Position::groupBy('subordinary_level')->pluck('subordinary_level');
        return view('admin.positions.create', ['subordinaryLevels' => $subordinaryLevels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function getSubPositions()
    {
        $subPositions = Position::where('parent_id', request('id'))->get();
    
        $positionNumber = count($subPositions);

        if($positionNumber > 0) {
            return response()->json([
                'message' => 'Attention! Position has '.$positionNumber.' subposition(s)', 
                'success' => false
            ]);
        }
        return response()->json([
            'message' => 'Are You shure to delete the Position#'.request('id').'?', 
            'success' => true
        ]);
    }
}
