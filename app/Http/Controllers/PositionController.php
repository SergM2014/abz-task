<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $positions = Position::all();
        return view('admin.positions.create', ['positions' => $positions]);
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
        //
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
        $supremeLevelId = request('subordinaryLevel')-1;

        if (!$supremeLevelId) {
            return [
                'results' =>[
                    [
                        'id'=> '0',
                        'text'=> 'This is the heighest subordinary level. It doesnot contain position!'
                    ]
                ]
            ];
        }

        $employees = Position::where('title', 'LIKE', '%'.$request->input('term', '').'%')
                    ->where('subordinary_level', $supremeLevelId)
                    ->get(['id', 'title as text']);

        return ['results' => $employees];
    }

    
}
