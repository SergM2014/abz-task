<?php

namespace App\Interfaces;

use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;

interface PositionInterface
{
    public function getAll(): Collection;

    public function getById(int $id): Position;
}