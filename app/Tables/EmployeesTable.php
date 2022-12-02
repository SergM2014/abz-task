<?php

namespace App\Tables;

use App\Models\Employee;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Table;

class EmployeesTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Employee::class)
            ->rowActions(fn(Employee $employee) => [
                new EditRowAction(route('employees.edit', $employee)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('id')->sortable(),
            Column::make('first_name')->title('first name')->searchable()->sortable(),
            Column::make('middle_name')->title('middle name')->searchable()->sortable(),
            Column::make('last_name')->title('last name')->searchable()->sortable(),
            Column::make('position_id')->title('position')->searchable()->sortable(),
            Column::make('leader_id')->title('leader')->searchable()->sortable(),
            Column::make('employment_date')->title('employment_date')->searchable()->sortable(),
            Column::make('phone')->title('phone')->searchable()->sortable(),
            Column::make('email')->title('email')->searchable()->sortable(),
            Column::make('salary')->title('salary')->searchable()->sortable(),
            Column::make('photo')->title('photo')->sortable(),
            Column::make('created_at')->title('created at')->format(new DateFormatter('d/m/Y H:i'))->sortable(),
            Column::make('updated_at')->title('updated at')->format(new DateFormatter('d/m/Y H:i'))->sortable()->sortByDefault('desc'),
        ];
    }

    protected function results(): array
    {
        return [
            // The table results configuration.
            // As results are optional on tables, you may delete this method if you do not use it.
        ];
    }
}
