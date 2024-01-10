<?php

namespace App\Filament\Resources\ReservationResource\RelationManagers;

use App\Models\Feature;
use App\Models\FeatureReservation;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FeaturesRelationManager extends RelationManager
{
    protected static string $relationship = 'features';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->maxLength(500),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->prefix('$'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('price')
                    ->sortable()
                    ->prefix('$'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                AttachAction::make()
                    ->attachAnother(false)
                    ->form( fn (AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->live()
                            ->getSearchResultsUsing(function (string $search, $livewire): array {
                                $existingFeatures = FeatureReservation::where('reservation_id', $livewire->ownerRecord->id)->pluck('feature_id')->toArray();

                                 return Feature::query()
                                    ->where('name', 'like', "%{$search}%")
                                    ->whereHas('rooms', function (Builder $query) use ($livewire) {
                                        $query->where('room_id', $livewire->ownerRecord->room_id);
                                    })
                                     ->whereNotIn('id', $existingFeatures)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            }),
                    ])->mutateFormDataUsing(function (array $data, $livewire): array {;
                        $feature_id = Feature::find($data['recordId'])->id;
                        $room_id = $livewire->ownerRecord->room_id;

                        $price = Room::find($room_id)->features()->where('feature_id', $feature_id)->first()->pivot->price;

                        $data['price'] = $price;

                        $price = $livewire->ownerRecord->price + $price;

                        $livewire->ownerRecord->update(['price' => $price]);

                        return $data;
                    })
                    ->after(function (Component $livewire) {
                        $livewire->dispatch('refreshPrices');
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make()
                ->after(function (Component $livewire) {
                    $reservation = $livewire->ownerRecord;

                    $features_prices = DB::table('feature_reservation')
                        ->where('reservation_id', $reservation->id)
                        ->pluck('price')
                        ->toArray();

                    $room_season_price = DB::table('room_season')
                        ->where('room_id', $reservation->room_id)
                        ->where('season_id', $reservation->season_id)
                        ->first()->price;

                    $reservation->update(['price' => $room_season_price + array_sum($features_prices)]);

                    $livewire->dispatch('refreshPrices');
                }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
