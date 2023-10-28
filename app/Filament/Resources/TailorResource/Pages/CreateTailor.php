<?php

namespace App\Filament\Resources\TailorResource\Pages;

use App\Filament\Resources\TailorResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTailor extends CreateRecord
{
    protected static string $resource = TailorResource::class;
    protected static ?string $title = 'Tambah Data Penjahit';
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
