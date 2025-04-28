<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HospitalResource\Pages;
use App\Models\Hospital;
use App\Models\Location;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Support\Str;
use Filament\Forms\Form;
use Filament\Tables\Table;

class HospitalResource extends Resource
{
    protected static ?string $model = Hospital::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Hospital Name') // Added label for clarity
                ->required()
                ->maxLength(255)
                ->afterStateUpdated(function (Forms\Set $set, $state) {
                    $set('slug', Str::slug($state));
                }),

            Forms\Components\TextInput::make('slug')
                ->label('Slug') // Added label
                ->disabled()
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('location_id')
                ->label('Location') // Added label
                ->relationship('location', 'name')
                ->required()
                ->searchable()
                ->preload(),

            Forms\Components\Textarea::make('address')
                ->label('Address') // Added label
                ->nullable()
                ->maxLength(500),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Hospital Name') // Added label for consistency
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug') // Added label for consistency
                    ->copyable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('location.name')
                    ->label('Location') // Added label for consistency
                    ->searchable()
                    ->sortable('location.name'), // Added sortable
                Tables\Columns\TextColumn::make('address')
                    ->label('Address') // Added label
                    ->limit(30),
            ])
            ->filters([
                // You can add filters here if needed
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
            'index' => Pages\ListHospitals::route('/'),
            'create' => Pages\CreateHospital::route('/create'),
            'edit' => Pages\EditHospital::route('/{record}/edit'),
        ];
    }
}
