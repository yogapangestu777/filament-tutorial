<?php

namespace App\Filament\Resources\BonusResource\Pages;

use App\Filament\Resources\BonusResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateBonus extends CreateRecord
{
    protected static string $resource = BonusResource::class;
    protected static ?string $title = 'Tambah Data Bonus';
    public function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->Body('Data Berhasil Disimpan')
            ->duration(5000)
            ->send();
    }
}
