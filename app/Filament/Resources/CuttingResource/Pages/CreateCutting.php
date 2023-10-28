<?php

namespace App\Filament\Resources\CuttingResource\Pages;

use App\Filament\Resources\CuttingResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCutting extends CreateRecord
{
    protected static string $resource = CuttingResource::class;

    protected static ?string $title = 'Tambah Data Pemotongan';
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
