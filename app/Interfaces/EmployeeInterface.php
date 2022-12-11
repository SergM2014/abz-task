<?php

namespace App\Interfaces;

use App\Models\Employee;
use Illuminate\Http\Request;

interface EmployeeInterface
{
    public function store(Request $request, array $valideted): void;

    public function getById(int $id): Employee;

    public function update(Request $request, array $valideted, int $id): void;
}