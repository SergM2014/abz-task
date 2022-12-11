<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface PositionInterface
{
    public function getAll(): Collection;
}