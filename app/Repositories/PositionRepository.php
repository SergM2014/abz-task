<?php

namespace App\Repositories;

use App\Interfaces\PositionInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Position;

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
}