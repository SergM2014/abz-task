<?php

namespace App\Tables;

use App\Models\Position;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Table;

class PositionsTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Position::class)
            ->rowActions(fn(Position $position) => [
                new EditRowAction(route('positions.edit', $position)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('id')->sortable(),
            Column::make('subordinary_level')->title('subordinaty_level')->sortable(),
            Column::make('title')->title('title')->searchable()->sortable(),
            Column::make('description')->title('description'),
            Column::make('parent_id')
                        ->format(function(Position $position)  {
                            if(!$parentId = $position->parent_id) return '---'; 
                            $position = Position::find($parentId);
                            return $position->title;
                        })
                        ->title('superior_position')->searchable()->sortable(),
            Column::make('created_at')->title('created at')->format(new DateFormatter('d/m/Y H:i'))->sortable(),
            Column::make('updated_at')->title('updated at')->format(new DateFormatter('d/m/Y H:i'))->sortable()->sortByDefault('desc'),
            Column::make('admin_created_at')->title('created by admin')->format(new DateFormatter('d/m/Y H:i'))->sortable(),
            Column::make('admin_updated_at')->title('updated by admin')->format(new DateFormatter('d/m/Y H:i'))->sortable()->sortByDefault('desc'),
        ];
    }


}
