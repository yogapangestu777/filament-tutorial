<?php

namespace App\Filament\Resources\TailorResource\Pages;

use App\Filament\Resources\TailorResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditTailor extends EditRecord
{
    protected static string $resource = TailorResource::class;
    protected static ?string $title = 'Edit Data Penjahit';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    public function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->Body('Data Berhasil Diubah')
            ->duration(5000)
            ->send();
    }
}
