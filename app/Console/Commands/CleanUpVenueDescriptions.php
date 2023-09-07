<?php

namespace App\Console\Commands;

use App\Models\Venue;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CleanUpVenueDescriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-up-venue-descriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("started cron job");

        // Set the timezone to Australia/Sydney
        date_default_timezone_set('Australia/Sydney');

        // Check if it's 9 AM in Australia/Sydney time
        if (Carbon::now()->format('H') === '09') {
            // Perform the venue description cleanup logic here
            $venues = Venue::where('description_cleaned', false)  
                ->whereNotNull('description') // Ensure description is not empty  
                ->limit(1000)
                ->get();

            $count = $venues->count(); // Get the total count

            if ($count > 0) {
                $this->info("Total venues to be cleaned: $count");
                foreach ($venues as $venue) {
                    $cleanedDescription = $this->cleanUpDescription($venue->description); // Call a function to clean up the description
                    $venue->update([
                        'description' => $cleanedDescription,
                        'description_cleaned' => true, // Update the description_cleaned column
                    ]);
                }
                $this->info('Venue descriptions cleaned up successfully.');
            } else {
                $this->info('No venues to be cleaned at this time.');
            }
        } else {
            $this->info('No cleanup required at this time.');
        }
    }

    private function cleanUpDescription($description)
    {
        // Remove HTML tags
        $cleanedDescription = strip_tags($description);

        // Remove non-alphanumeric characters and extra whitespaces
        $cleanedDescription = preg_replace('/[^a-zA-Z0-9\s]+/', '', $cleanedDescription);
        
        // Remove extra whitespaces and trim
        $cleanedDescription = preg_replace('/\s+/', ' ', $cleanedDescription);
        $cleanedDescription = trim($cleanedDescription);

        return $cleanedDescription;
    }
}
