<?php

namespace App\Filament\Resources\ChamberResource\Pages;

use App\Filament\Resources\ChamberResource;
use App\Models\Chamber;
use Filament\Actions;
use Filament\Forms\Components\Builder;
use Filament\Resources\Pages\ListRecords;


class ListChambers extends ListRecords
{
    protected static string $resource = ChamberResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    
}
