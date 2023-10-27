<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
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
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Data Pegawai';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    TextInput::make(name: 'name')->label('Nama')->required(),
                    TextInput::make(name: 'email')->label('Email')->required(),
                    TextInput::make(name: 'phone')->label('No Telepon')->required(),
                    DatePicker::make(name: 'entrance_date')->label('Tanggal Masuk')->required(),
                    TextInput::make(name: 'salary')->label('Gaji')->required(),
                    Hidden::make(name: 'password')->default(Hash::make('Dstcollection123@'))->label('Gaji')->required(),
                    Select::make('status')
                        ->label('Status Akun')
                        ->options([
                            'active' => 'Aktif',
                            'inactive' => 'Tidak Aktif',
                        ])
                        ->required(),
                    Select::make('role')
                        ->label('Role')
                        ->options([
                            '1' => 'Leader',
                            '2' => 'Admin',
                            '3' => 'Cutting',
                            '4' => 'Operator',
                        ])
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable(),
                TextColumn::make('phone')->label('no Telepon')->searchable(),
                TextColumn::make('entrance_date')->label('Tanggal Masuk')->searchable(),
                TextColumn::make('out_date')->label('Tanggal Keluar')->searchable(),
                TextColumn::make('salary')->label('Gaji Pokok')->searchable(),
                TextColumn::make('status')->label('Status Akun')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                    })
                    ->searchable(),
            ])
            ->filters([
                // Tables\Filters\TrashedFilter::make(),
            ])
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
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
