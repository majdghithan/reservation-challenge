<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BuildingsRelationManager extends RelationManager
{
    protected static string $relationship = 'buildings';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Buildings');
    }

    public static function getModelLabel(): ?string
    {
        return __('Building');
    }

    public static function getPluralModelLabel(): ?string
    {
        return __('Buildings');
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('exact_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->nullable()
                    ->maxLength(500),
                Forms\Components\FileUpload::make('featured_image')
                    ->image()
                    ->directory('buildings')
                    ->required(),
                Forms\Components\Select::make('property_type_id')
                    ->required()
                    ->relationship('propertyType', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->unique('property_types', 'name')
                            ->maxLength(255),
                    ]),

                Forms\Components\Select::make('User')
                    ->required()
                    ->preload()
                    ->relationship('user', 'name'),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\DetachAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }

}
