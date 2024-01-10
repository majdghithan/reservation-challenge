<?php

use App\Livewire\CreateReservation;
use App\Livewire\Home;
use App\Livewire\ShowBuilding;
use App\Livewire\ShowRoom;
use App\Livewire\Success;
use Illuminate\Support\Facades\Route;

//BUILDINGS
Route::get('/buildings', Home::class)->name('buildings.index');
Route::get('/buildings/{building}', ShowBuilding::class)->name('buildings.show');

Route::get('/success', Success::class)->name('success');

//ROOMS
Route::get('/rooms/{room}', ShowRoom::class)->name('rooms.show');

//RESERVE FORM
Route::get('/reservation/{room}', CreateReservation::class)->name('reservation.create');

//solution for throwing an error when running migrate fresh for auth user
Route::get('redirect-to-login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');

Route::get('/', function () {
    return redirect()->route('buildings.index');
});
