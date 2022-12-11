<?php

namespace App\Interfaces;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

interface EmployeeInterface
{
    public function store(Request $request, array $valideted): void;

    public function getById(int $id): Employee;

    public function update(Request $request, array $valideted, int $id): void;

    public function search(Request $request, int $superiorId): Collection;

    public function getLeader(): Employee;

    public function getSubordinates(int $id): Collection;

    public function delete(): void;

    public function getLeaderWithPosition(): Employee;

    public function getSiblingsNumber($positionId, $leaderId): int;

    public function searchLeaders(Request $request): array;

    public function changeLeader(): void;

    public function deleteById(): void;

    public function getEmployeesByPositionId(): Collection;

    public function changePosition(): void;
}