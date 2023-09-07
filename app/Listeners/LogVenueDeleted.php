<?php

namespace App\Listeners;

use App\Models\EventLog;
use App\Events\VenueDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogVenueDeleted
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
    public function handle(VenueDeleted $event): void
    {
        // Create a log entry in the database
        EventLog::create([
            'event_type' => 'venue_deleted',
            'model' => 'venue',
            'model_id' => $event->venue->id,
        ]);
    }
}
