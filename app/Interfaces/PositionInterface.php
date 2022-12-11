<?php

namespace App\Interfaces;

use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\CreatePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use Illuminate\Support\Collection as SupportCollection;

interface PositionInterface
{
    public function getAll(): Collection;

    public function getById(int $id): Position;

    public function getSubordinaryLevels(): array;

    public function store(CreatePositionRequest $request, array $validated): void;

    public function update(UpdatePositionRequest $request, array $validated, int $id): void;

    public function delete(int $id): void;

    public function getPositionsBySupremeLevelId(int $supremeLevelId): SupportCollection;

    public function getSubPositions(): SupportCollection;

    public function getSiblingsPosition(int $subordinaryLevel): SupportCollection;

    public function getPositionsBySubLevelAndId(int $subordinaryLevel): SupportCollection;

    public function changeUpperPosition(): void;
}