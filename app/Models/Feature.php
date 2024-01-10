<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    //assuming every feature has its own price in a certain room
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class)->withTimestamps()->withPivot('price');
    }

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class)->withTimestamps()->withPivot('price');
    }

    //get the price of the feature in a certain room
    public function getPriceAttribute(): float
    {
        return $this->pivot->price;
    }
}
