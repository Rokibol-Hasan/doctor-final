<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Models\Doctor;
use App\Models\Location;
use App\Models\Specialization;
use App\Models\Hospital;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Filament\Forms\Form;
use Filament\Tables\Table;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Doctor Name')
                ->required(),

            Select::make('location_id')
                ->label('Location')
                ->relationship('location', 'name') // Use the correct relationship
                ->required(),

            Select::make('specialization_id')
                ->label('Specialization')
                ->relationship('specialization', 'name') // Use the correct relationship
                ->required(),

            TextInput::make('phone')
                ->label('Phone')
                ->nullable(),

            TextInput::make('email')
                ->label('Email')
                ->email() // Add email validation
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('location.name')
                    ->label('Location')
                    ->searchable()
                    ->sortable('location.name'), // Add sortable for related column

                TextColumn::make('specialization.name')
                    ->label('Specialization')
                    ->searchable()
                    ->sortable('specialization.name'), // Add sortable for related column
                TextColumn::make('phone')
                    ->label('Phone')
                    ->limit(15),

                TextColumn::make('email')
                    ->label('Email')
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
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}
