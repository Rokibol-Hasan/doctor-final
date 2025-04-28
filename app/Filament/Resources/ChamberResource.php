<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChamberResource\Pages;
use App\Models\Chamber;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ChamberResource extends Resource
{
    public static ?string $model = Chamber::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
{
    return $form->schema([
        Select::make('doctor_id')
            ->label('Doctor')
            ->relationship('doctor', 'name')
            ->required(),

        Select::make('hospital_id')
            ->label('Hospital')
            ->options(Hospital::all()->pluck('name', 'id'))
            ->reactive()
            ->afterStateUpdated(function (callable $set, callable $get, $state) {
                if ($state) {
                    $hospital = Hospital::find($state);
                    if ($hospital) {
                        $set('location_id', $hospital->location_id);

                        // Optional: show location name (if you want)
                        $location = Location::find($hospital->location_id);
                        if ($location) {
                            $set('location_name', $location->name);
                        } else {
                            $set('location_name', null);
                        }
                    } else {
                        $set('location_id', null);
                        $set('location_name', null);
                    }
                }
            })
            ->required(),

            Hidden::make('location_id')
            ->reactive(),
        

        TextInput::make('location_name')
            ->label('Location')
            ->disabled()
            ->dehydrated(false) // don't save this into database
            ->reactive(),

        Textarea::make('address')
            ->label('Address')
            ->nullable(),

        TextInput::make('visiting_hours')
            ->label('Visiting Hours')
            ->nullable(),

        TextInput::make('days')
            ->label('Days')
            ->nullable(),

        TextInput::make('contact_number')
            ->label('Contact Number')
            ->nullable(),
    ]);
}


    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('doctor.name')
                    ->label('Doctor')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('doctor', function (Builder $query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        });
                    })
                    ->sortable('doctor.name'),
                Tables\Columns\TextColumn::make('hospital.name') // Added Hospital Name
                    ->label('Hospital')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('hospital', function (Builder $query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        });
                    })
                    ->sortable('hospital.name'),
                Tables\Columns\TextColumn::make('location.name')
                    ->label('Location')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('location', function (Builder $query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        });
                    })
                    ->sortable('location.name'),
                Tables\Columns\TextColumn::make('address')
                    ->limit(50),
                Tables\Columns\TextColumn::make('contact_number')
                    ->limit(20),
                Tables\Columns\TextColumn::make('visiting_hours')
                    ->label('Visiting Hours'),
                Tables\Columns\TextColumn::make('days')
                    ->label('Days'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('doctor.name');
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChambers::route('/'),
            'create' => Pages\CreateChamber::route('/create'),
            'edit' => Pages\EditChamber::route('/{record}/edit'),
        ];
    }
}
