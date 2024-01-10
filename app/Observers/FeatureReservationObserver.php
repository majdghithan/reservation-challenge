<?php

namespace App\Observers;

use App\Models\FeatureReservation;

class FeatureReservationObserver
{
    /**
     * Handle the FeatureReservation "created" event.
     */
    public function created(FeatureReservation $featureReservation): void
    {
        //
    }

    /**
     * Handle the FeatureReservation "updated" event.
     */
    public function updated(FeatureReservation $featureReservation): void
    {
        //
    }

    /**
     * Handle the FeatureReservation "deleted" event.
     */
    public function deleted(FeatureReservation $featureReservation): void
    {
        //
    }

    /**
     * Handle the FeatureReservation "restored" event.
     */
    public function restored(FeatureReservation $featureReservation): void
    {
        //
    }

    /**
     * Handle the FeatureReservation "force deleted" event.
     */
    public function forceDeleted(FeatureReservation $featureReservation): void
    {
        //
    }

    //creating
    public function creating(FeatureReservation $featureReservation): void
    {
        $featureReservation->price = $featureReservation->feature?->price;
    }
}
