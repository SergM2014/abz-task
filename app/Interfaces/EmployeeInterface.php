<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface EmployeeInterface
{
    public function getAllPositions(): Collection;

    public function store(Request $request, array $valideted): void;
}