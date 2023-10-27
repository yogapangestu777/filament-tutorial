<?php

namespace App\Filament\Resources\CuttingResource\Pages;

use App\Filament\Resources\CuttingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCutting extends CreateRecord
{
    protected static string $resource = CuttingResource::class;
    
    protected static ?string $title = 'Tambah Data Pemotongan';
}
