<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
                TextInput::make('name')->required()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                TextColumn::make('name')->searchable()
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
