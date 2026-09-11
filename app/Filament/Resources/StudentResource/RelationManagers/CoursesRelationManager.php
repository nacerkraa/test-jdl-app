<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Schemas\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CoursesRelationManager extends RelationManager
{
    protected static string $relationship = 'courses';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required()
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
            TextColumn::make('name')->searchable()
            ])
            ->headerActions([
            AttachAction::make()->preloadRecordSelect(),
            ])
            ->recordActions([
            DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                DetachBulkAction::make(),
                ]),
            ]);
    }
}
