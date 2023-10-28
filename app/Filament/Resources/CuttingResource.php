<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CuttingResource\Pages;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Cutting;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class CuttingResource extends Resource
{
    protected static ?string $model = Cutting::class;

    protected static ?string $navigationIcon = 'heroicon-o-scissors';

    protected static ?string $navigationLabel = 'Pemotongan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Hidden::make(name: 'enhancer')->default(Auth::user()->id),
                    TextInput::make(name: 'roll')->label('Roll')->required(),
                    TextInput::make(name: 'cutting_result')->label('Hasil Potongan')->required(),
                    TextInput::make(name: 'material')->label('Bahan')->required(),
                    TextInput::make(name: 'size')->label('Ukuran')->required(),
                    TextInput::make(name: 'model')->label('Model')->required(),
                    TextInput::make(name: 'motive')->label('Motif')->required(),
                    TextInput::make(name: 'product')->label('Produk')->required(),
                    Hidden::make(name: 'date')->default(now()->format('Y-m-d'))
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('getenhancer.name')->label('Nama')->searchable(),
                TextColumn::make('date')->label('Tanggal')->searchable(),
                TextColumn::make('roll')->label('Roll')->searchable(),
                TextColumn::make('cutting_result')->label('Hasil Potongan')->searchable(),
                TextColumn::make('material')->label('Bahan')->searchable(),
                TextColumn::make('size')->label('Ukuran')->searchable(),
                TextColumn::make('model')->label('Model')->searchable(),
                TextColumn::make('motive')->label('Motif')->searchable(),
                TextColumn::make('product')->label('Produk')->searchable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->whereNull('deleted_at');;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCuttings::route('/'),
            'create' => Pages\CreateCutting::route('/create'),
            'view' => Pages\ViewCutting::route('/{record}'),
            'edit' => Pages\EditCutting::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('getenhancer');
    }
}
