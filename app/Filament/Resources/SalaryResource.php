<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalaryResource\Pages;
use App\Models\Bonus;
use App\Models\Salary;
use App\Models\User;
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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class SalaryResource extends Resource
{
    protected static ?string $model = Salary::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Salary';
    protected static ?string $modelLabel = 'Salary';
    protected static ?string $navigationGroup = 'Kelola';
    protected static ?int $navigationSort = 5;
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
                    Select::make('enhancer')
                        ->label('Pegawai')
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                    TextInput::make(name: 'amount')->label('Nominal')->required()->placeholder('Masukan Nominal Gaji'),
                    Select::make('bonus')
                        ->label('Bonus')
                        ->options(Bonus::all()->pluck('amount', 'id'))
                        ->searchable()
                        ->required(),
                    Textarea::make(name: 'information')->label('Infomari')->required()->placeholder('Masukan Informasi'),
                    Hidden::make(name: 'date')->default(now()->format('Y-m-d'))
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('getenhancer.name')->label('Nama')->sortable()->searchable(),
                TextColumn::make('date')->label('Tanggal')->sortable()->searchable(),
                TextColumn::make('amount')->label('Jumlah')->sortable()->searchable(),
                TextColumn::make('getbonus.amount')->label('Bonus')->sortable()->searchable(),
                TextColumn::make('information')->label('Informasi')->sortable()->searchable(),
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
            'index' => Pages\ListSalaries::route('/'),
            'create' => Pages\CreateSalary::route('/create'),
            'view' => Pages\ViewSalary::route('/{record}'),
            'edit' => Pages\EditSalary::route('/{record}/edit'),
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
