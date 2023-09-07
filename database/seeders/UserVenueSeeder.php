<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserVenueSeeder extends Seeder
{
    public function run(): void
    {
        // admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);
        
        $managers = User::factory()->count(5)->create();
        $venues = Venue::factory()->count(10)->create();

        $managers->each(function ($manager) use ($venues) {
            $manager->staff()->saveMany(User::factory()->count(4)->create([
                'role_id' => 3,
            ]));
        });

        // Update venues to set the userId to the manager's ID
        $venues->each(function ($venue) use ($managers) {
            $manager = $managers->random();
            $venue->user_id = $manager->id;
            $venue->save();
        });
    }
}
