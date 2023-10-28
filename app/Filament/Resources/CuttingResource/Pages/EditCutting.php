<?php

namespace App\Filament\Resources\CuttingResource\Pages;

use App\Filament\Resources\CuttingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditCutting extends EditRecord
{
    protected static string $resource = CuttingResource::class;
    protected static ?string $title = 'Edit Data Pemotongan';

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
