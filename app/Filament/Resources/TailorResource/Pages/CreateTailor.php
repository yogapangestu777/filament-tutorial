<?php

namespace App\Filament\Resources\TailorResource\Pages;

use App\Filament\Resources\TailorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTailor extends CreateRecord
{
    protected static string $resource = TailorResource::class;
    protected static ?string $title = 'Tambah Data Penjahit';

}
