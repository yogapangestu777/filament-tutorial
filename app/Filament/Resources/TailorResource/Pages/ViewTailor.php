<?php

namespace App\Filament\Resources\TailorResource\Pages;

use App\Filament\Resources\TailorResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTailor extends ViewRecord
{
    protected static string $resource = TailorResource::class;
    protected static ?string $title = 'Lihat Data Penjahit';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
