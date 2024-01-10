<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'room_type_id',
        'building_id',
        'image',
    ];

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function seasons(): BelongsToMany
    {
        return $this->belongsToMany(Season::class)->withPivot('price')->withTimestamps();
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class)->withPivot('price')->withTimestamps();
    }

    //current_price attribute
    public function getCurrentPriceAttribute()
    {
        return $this->seasons->where('start_date', '<=', now())->where('end_date', '>=', now())->first()?->pivot->price;
    }

    public function getCurrentSeasonAttribute()
    {
        return $this->seasons->where('start_date', '<=', now())->where('end_date', '>=', now())->first();
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    protected static function booted(): void
    {
        if(auth()->check() && !auth()->user()->hasRole('super_admin')){
            static::addGlobalScope('room_owner',
                fn ($query) => $query->whereHas('building',
                    fn ($query) => $query->where('user_id', auth()->id()))
            );
        }
    }
}
