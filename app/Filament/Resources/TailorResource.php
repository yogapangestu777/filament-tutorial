<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TailorResource\Pages;
use App\Models\Tailor;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class TailorResource extends Resource
{
    protected static ?string $model = Tailor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Penjahit';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Select::make('enhancer')
                        ->label('Pegawai')
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                    TextInput::make(name: 'motive')->label('Motif')->placeholder('Masukan Motif')->required(),
                    Radio::make('type')
                        ->label('Tipe')
                        ->options([
                            '0' => 'Jahit Biasa',
                            '1' => 'Sample'
                        ])
                        ->required(),
                    TextInput::make(name: 'amount')->label('Jumlah')->required(),
                    FileUpload::make('image')->label('Gambar')->required(),
                    Textarea::make(name: 'information')->label('Informasi')->required(),
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
                TextColumn::make('motive')->label('Motif')->searchable(),
                TextColumn::make('type')->label('Tipe')->searchable(),
                TextColumn::make('amount')->label('Jumlah')->searchable(),
                ImageColumn::make('image')->label('Gambar'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->tableFilters('');
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
            'index' => Pages\ListTailors::route('/'),
            'create' => Pages\CreateTailor::route('/create'),
            'view' => Pages\ViewTailor::route('/{record}'),
            'edit' => Pages\EditTailor::route('/{record}/edit'),
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
