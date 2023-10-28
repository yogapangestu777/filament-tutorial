<?php

namespace App\Filament\Resources\BonusResource\Pages;

use App\Filament\Resources\BonusResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditBonus extends EditRecord
{
    protected static string $resource = BonusResource::class;
    protected static ?string $title = 'Edit Data Bonus';

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
