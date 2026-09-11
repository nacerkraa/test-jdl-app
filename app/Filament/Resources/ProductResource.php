<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\SelectFilter;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
                TextInput::make('name')->required(),
                TextInput::make('price')->numeric()->required(),
                Toggle::make('in_stock'),
                Select::make('status')->options(['DRAFT' => 'DRAFT', 'ACTIVE' => 'ACTIVE', 'ARCHIVED' => 'ARCHIVED']),
                Select::make('category_id')->relationship('category', 'name')->searchable()->preload(),
                Select::make('warehouse_id')->relationship('warehouse', 'code')->searchable()->preload()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('price')->numeric()->sortable(),
                IconColumn::make('in_stock')->boolean(),
                TextColumn::make('status')->badge(),
                TextColumn::make('category.name')->sortable()->searchable(),
                TextColumn::make('warehouse.code')->sortable()->searchable()
        ])->filters([
                TernaryFilter::make('in_stock'),
                SelectFilter::make('status')->options(['DRAFT' => 'DRAFT', 'ACTIVE' => 'ACTIVE', 'ARCHIVED' => 'ARCHIVED']),
                SelectFilter::make('category')->relationship('category', 'name')->searchable()->preload(),
                SelectFilter::make('warehouse')->relationship('warehouse', 'code')->searchable()->preload()
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
