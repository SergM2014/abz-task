<?php

namespace App\Interfaces;


use Illuminate\Http\Request;

interface EmployeeInterface
{
    public function store(Request $request, array $valideted): void;
}