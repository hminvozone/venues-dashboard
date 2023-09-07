<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Role::insert([
            ['name' => 'Administrator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Venue Managers', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Venue Staff', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
