<?php

namespace App\Filament\Resources\TailorResource\Pages;

use App\Filament\Resources\TailorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTailor extends EditRecord
{
    protected static string $resource = TailorResource::class;
    protected static ?string $title = 'Edit Data Penjahit';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
