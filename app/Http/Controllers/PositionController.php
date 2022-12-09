<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
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
    public function store(CreatePositionRequest $request)
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

        return view('admin.positions.update', [
            'position' => $position,
            'subordinaryLevels' => $subordinaryLevels,
            'subordinaryLevel' => $subordinaryLevel
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePositionRequest $request, $id)
    {
        $validated = $request->validated();

        $position = Position::find($id);
        $position->subordinary_level = $validated['subordinaryLevel'];
        $position->title = $validated['title'];
        $position->description = $validated['description'];
        $position->parent_id =  $validated['supremePositionIdSelect'];
        $position->admin_updated_id = $request->user()->id;

        $position->save();

        return redirect()->route('positions.index')->with('success','A new position'.$id.' was updated!');
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

    public function getSupremePosition(Request $request): JsonResponse
    {
        if (!request('parentId')) {
            return response()->json(['id' => 0, 'text' => 'it is the highest hierachical level! No suprem positions at all!']);
        }

        $position = Position::where('id', request('parentId'))
                ->first(['id', 'title as text']);

         return response()->json(['id' => $position->id, 'text' => $position->text]);
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
}
