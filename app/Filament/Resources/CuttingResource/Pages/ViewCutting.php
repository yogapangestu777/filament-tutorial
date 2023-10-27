<?php

namespace App\Filament\Resources\CuttingResource\Pages;

use App\Filament\Resources\CuttingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCutting extends ViewRecord
{
    protected static string $resource = CuttingResource::class;
    protected static ?string $title = 'Lihat Data Pemotongan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
