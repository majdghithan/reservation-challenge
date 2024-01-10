<?php

namespace App\Models;

use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    use HasFactory;
    use HasPrice;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'price',
        'start_date',
        'end_date',
        'persons',
        'notes',
        'is_paid',
        'season_id',
        'room_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_paid' => 'boolean',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class)->withTimestamps()->withPivot('price');
    }

    protected static function booted(): void
    {
        if(auth()->check() && !auth()->user()->hasRole('super_admin')){
            static::addGlobalScope('reservation',
                fn ($query) => $query->whereHas('room',
                fn ($query) => $query->whereHas('building',
                    fn ($query) => $query->where('user_id', auth()->id())))
            );
        }
    }

}
