<?php

namespace App\Listeners;

use App\Models\EventLog;
use App\Events\VenueUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogVenueUpdated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VenueUpdated $event): void
    {
        // Create a log entry in the database
        EventLog::create([
            'event_type' => 'venue_updated',
            'model' => 'venue',
            'model_id' => $event->venue->id,
        ]);
    }
}
