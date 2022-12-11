<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeInterface
{
    public function getAllPositions(): Collection
    {
        return Position::all('id', 'title');
    }
}