<?php

namespace App\Filament\Resources\CuttingResource\Pages;

use App\Filament\Resources\CuttingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Query\Builder;

class ListCuttings extends ListRecords
{
    protected static ?string $title = 'Data Pemotongan';
    protected static string $resource = CuttingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // public function getTabs(): array
    // {
    //     return [
    //         'Semua' => Tab::make(),
    //         'Minggu Ini' => Tab::make()
    //             ->modifyQueryUsing(fn (Builder $query) => $query->where(''))
    //     ];
    // }
}
