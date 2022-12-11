<?php

namespace App\Repositories;

use App\Interfaces\PositionInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Position;
use App\Http\Requests\CreatePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;
use Livewire\Features\SupportCollections;

class PositionRepository implements PositionInterface
{
    public function getAll(): Collection
    {
        return Position::all('id', 'title');
    }

    public function getById(int $id): Position
    {
        return Position::find($id);
    }

    public function getSubordinaryLevels(): array
    {
        return Position::groupBy('subordinary_level')->pluck('subordinary_level');
    }

    public function store(CreatePositionRequest $request, array $validated): void
    {
        $position = new Position;
        $position->subordinary_level = $validated['subordinaryLevel'];
        $position->title = $validated['title'];
        $position->description = $validated['description'];
        $position->parent_id = $validated['supremePositionIdSelect'];
        $position->admin_created_id = $request->user()->id;

        $position->save();
    }

    public function update(UpdatePositionRequest $request, array $validated, int $id): void
    {
        //$position = Position::find($id);
        $position = $this->getById($id);
        $position->subordinary_level = $validated['subordinaryLevel'];
        $position->title = $validated['title'];
        $position->description = $validated['description'];
        $position->parent_id =  $validated['supremePositionIdSelect'];
        $position->admin_updated_id = $request->user()->id;

        $position->save();
    }

    public function delete(int $id): void
    {
        Position::destroy($id);
    }

    public function getPositionsBySupremeLevelId(int $supremeLevelId): SupportCollection
    {
        return Position::where('subordinary_level', $supremeLevelId )->get(['id', 'title as text']);
    }

    public function getSubPositions(): SupportCollection
    {
        //Position::where('parent_id', request('id'))->first();
        return DB::table('positions')->where('parent_id', request('id'))->get();
    }

    public function getSiblingsPosition($subordinaryLevel): SupportCollection
    {
        return Position::where('subordinary_level', $subordinaryLevel)
                        ->whereNot('id', request('id'))->get();
    }

    public function getPositionsBySubLevelAndId(int $subOrdinaryLevel): SupportCollection
    {
        return Position::where('subordinary_level', $subOrdinaryLevel)
                        ->where('parent_id', request('id'))
                        ->get();
    }

    public function changeUpperPosition(): void
    {
        DB::table('positions')->where('parent_id', request('id'))->update(['parent_id' => request('siblingsPosition')]);
    }
}