<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Filament\Resources\RoomResource\RelationManagers\FeaturesRelationManager;
use App\Models\Reservation;
use App\Models\Room;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make("Information")
                    ->columns(3)
            ->schema([

                Forms\Components\Select::make('room_id')
                    ->relationship('room', 'name')
                    ->required()
                    ->live()
                    ->afterStateUpdated(static::getTotalPrice()),

                Forms\Components\Select::make('season_id')
                    ->relationship('season', 'name')
                    ->hidden()
                    ->preload()
                    ->required(),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_date')
                    ->after('yesterday')
                    ->before('end_date')
                    ->live()
                    ->afterStateUpdated(static::setCurrentSeason())
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->rules(['after:start_date',
                        fn (Get $get, ?Model $record): Closure => function (string $attribute, $value, Closure $fail) use ($get, $record) {

                            $room_id = $get('room_id');
                            $start_date = $get('start_date');
                            $end_date = $get('end_date');

                            $isAvailable = Reservation::where('room_id', $room_id)
                                ->where(function (Builder $query) use ($start_date, $end_date) {
                                    $query->whereBetween('start_date', [$start_date, $end_date])
                                        ->orWhereBetween('end_date', [$start_date, $end_date]);
                                })
                                ->doesntExist();

                            //exclude current record from the check
                            if($record != null){
                                $isAvailable = Reservation::where('room_id', $room_id)
                                ->where(function (Builder $query) use ($start_date, $end_date) {
                                    $query->whereBetween('start_date', [$start_date, $end_date])
                                        ->orWhereBetween('end_date', [$start_date, $end_date]);
                                })
                                ->where('id', '!=', $record->id)
                                ->doesntExist();
                            }

                            if (!$isAvailable) {
                                $fail('The room is not available for the selected dates.');
                            }
                        },
                    ])
                    ->required()
                    ->live()
                    ->afterStateUpdated(
                        function (Forms\Contracts\HasForms $livewire, Forms\Components\DatePicker $component, Get $get, Set $set) {
                            self::setCurrentSeason()($get, $set);
                            self::getTotalPrice()($get, $set);
                            $livewire->validateOnly($component->getStatePath());
                    }),
                TextInput::make('persons')
                    ->live(onBlur: true)
                    ->required()
                    ->numeric(),

                Forms\Components\Textarea::make('notes')
                    ->maxLength(500),

                Forms\Components\Toggle::make('is_paid')
                    ->required(),

            ]),

                Forms\Components\Section::make('Total Price')
                    ->schema([
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->readOnlyOn(['edit'])
                            ->prefix('$')
                    ])

            ]);
    }

    /*
     * Calculating total price depending on season, room & features & # of persons.
     *
     */
    protected static function getTotalPrice(): callable
    {
        return function (Get $get, Set $set){
            if($get('season_id') == null || $get('room_id') == null){
                return null;
            }

            $season_price = DB::table('room_season')
                ->where('room_id', $get('room_id'))
                ->where('season_id', $get('season_id'))
                ->first()
                ?->price;

            return $set('price', $season_price);
        };
    }

    /*
     * Setting current season depending on start & end dates.
     *
     */
    protected static function setCurrentSeason(): callable
    {
        return function (Get $get, Set $set){
            if($get('start_date') == null || $get('end_date') == null){
                return null;
            }

            $season = DB::table('seasons')
                ->where('start_date', '<=', $get('start_date'))
                ->where('end_date', '>=', $get('end_date'))
                ->first();

            //check if season is available in the room
            $room_season = DB::table('room_season')
                ->where('room_id', $get('room_id'))
                ->where('season_id', $season?->id)
                ->first();

            if($room_season == null ){
                return;
            }
            return $set('season_id', $season?->id);
        };
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('season.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('room.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('persons')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('notes')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_paid')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FeaturesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
