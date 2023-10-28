<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CuttingResource\Pages;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Cutting;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Support\Facades\Auth;

class CuttingResource extends Resource
{
    protected static ?string $model = Cutting::class;
    protected static ?string $navigationIcon = 'heroicon-o-scissors';
    protected static ?string $navigationLabel = 'Pemotongan';
    protected static ?string $modelLabel = 'Pemotongan';
    protected static ?string $navigationGroup = 'Master';
    protected static ?int $navigationSort = 1;
    public static function shouldRegisterNavigation(): bool
    {
        if (Auth::user()->role == 2 || Auth::user()->role == 3) {
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
                TextColumn::make('getenhancer.name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('date')->label('Tanggal')->sortable()->searchable(),
                TextColumn::make('roll')->label('Roll')->sortable()->searchable(),
                TextColumn::make('cutting_result')->label('Hasil Potongan')->sortable()->searchable(),
                TextColumn::make('material')->label('Bahan')->sortable()->searchable(),
                TextColumn::make('size')->label('Ukuran')->sortable()->searchable(),
                TextColumn::make('model')->label('Model')->sortable()->searchable(),
                TextColumn::make('motive')->label('Motif')->sortable()->searchable(),
                TextColumn::make('product')->label('Produk')->sortable()->searchable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('Pegawai')
                    ->relationship('getenhancer', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('date')
                    ->form([
                        DatePicker::make('created_from')->label("Dari"),
                        DatePicker::make('created_until')->label('Sampai'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->columnSpan(2)
                    ->columns(2)
            ], layout: FiltersLayout::AboveContent)->filtersFormColumns(3)
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
