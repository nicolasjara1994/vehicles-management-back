<?php

namespace App\Listeners;

use App\Models\Vehicle;
use App\Models\HistoryUserVehicle;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VehicleEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return void
     */
    public function created(Vehicle $vehicle)
    {
        HistoryUserVehicle::create([
            "owner_id" => $vehicle->owner()->id,
            "vehicle_id" => $vehicle->id,
        ]);
    }

    public function updated(Vehicle $vehicle)
    {
        $originalData = $vehicle->getOriginal();
        $changedData = $vehicle->getChanges();

        if ($originalData->owner != $changedData['owner']) {
            HistoryUserVehicle::create([
                "owner_id" => $vehicle->owner()->id,
                "vehicle_id" => $vehicle->id,
            ]);
        }
        
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
}
