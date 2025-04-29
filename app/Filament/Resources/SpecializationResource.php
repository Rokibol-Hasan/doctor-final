<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecializationResource\Pages;
use App\Models\Location;
use App\Models\Specialization;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Support\Str;
use Filament\Forms\Form;
use Filament\Tables\Table;

class SpecializationResource extends Resource
{
    protected static ?string $model = Specialization::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\TextInput::make('name')
            ->label('Specialization Name')
            ->required()
            ->maxLength(255)
            ->afterStateUpdated(function (Forms\Set $set, $state) {
                $set('slug', Str::slug($state));
            }),

        Forms\Components\TextInput::make('slug')
            ->label('Slug')
            ->disabled()
            ->required()
            ->maxLength(255),

        // Add the location field to the form
        Forms\Components\Select::make('location_id')
            ->label('Location')
            ->options(Location::all()->pluck('name', 'id'))
            ->required()
            ->searchable(),
    ]);
}
public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Name')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('slug')
                ->label('Slug')
                ->copyable()
                ->searchable(),

            // Show the Location name
            Tables\Columns\TextColumn::make('location.name')
                ->label('Location')
                ->sortable(),
        ])
        ->filters([
            // Optional filters
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ])
        ->defaultSort('name');
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpecializations::route('/'),
            'create' => Pages\CreateSpecialization::route('/create'),
            'edit' => Pages\EditSpecialization::route('/{record}/edit'),
        ];
    }
}
