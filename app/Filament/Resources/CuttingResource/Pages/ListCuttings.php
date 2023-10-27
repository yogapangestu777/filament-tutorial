<?php

namespace App\Filament\Resources\CuttingResource\Pages;

use App\Filament\Resources\CuttingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCuttings extends ListRecords
{
    protected static ?string $title = 'Data Data Pemotongan';
    protected static string $resource = CuttingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
