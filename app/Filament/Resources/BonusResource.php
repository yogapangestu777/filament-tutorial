<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BonusResource\Pages;
use App\Models\Bonus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class BonusResource extends Resource
{
    protected static ?string $model = Bonus::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Bonus';
    protected static ?string $modelLabel = 'Bonus';
    protected static ?string $navigationGroup = 'Kelola';
    protected static ?int $navigationSort = 2;
    public static function shouldRegisterNavigation(): bool
    {
        if (Auth::user()->role == 2) {
            return true;
        }

        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Hidden::make(name: 'enhancer')->default(Auth::user()->id),
                    TextInput::make(name: 'amount')->label('Jumlah')->required()->placeholder('Masukan Jumlah Diskon'),
                    Hidden::make(name: 'date')->default(now()->format('Y-m-d'))
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')->label('Tanggal')->sortable()->searchable(),
                TextColumn::make('amount')->label('Jumlah')->sortable()->searchable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Data');
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
            'index' => Pages\ListBonuses::route('/'),
            'create' => Pages\CreateBonus::route('/create'),
            'view' => Pages\ViewBonus::route('/{record}'),
            'edit' => Pages\EditBonus::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
