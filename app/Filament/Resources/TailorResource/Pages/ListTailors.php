<?php

namespace App\Filament\Resources\TailorResource\Pages;

use App\Filament\Resources\TailorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTailors extends ListRecords
{
    protected static ?string $title = 'Data Penjahit';
    protected static string $resource = TailorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
