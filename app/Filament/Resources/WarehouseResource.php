<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WarehouseResource\Pages;
use App\Models\Warehouse;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class WarehouseResource extends Resource
{
    protected static ?string $model = Warehouse::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
                TextInput::make('code')->required()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                TextColumn::make('code')->searchable()
        ])->filters([
                //
        ])->paginationPageOptions([10, 25, 50, 100])->recordActions([
            Actions\EditAction::make(),
        ])->toolbarActions([
            Actions\BulkActionGroup::make([
                Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array { return [/* */]; }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWarehouses::route('/'),
            'create' => Pages\CreateWarehouse::route('/create'),
            'edit' => Pages\EditWarehouse::route('/{record}/edit'),
        ];
    }
}
