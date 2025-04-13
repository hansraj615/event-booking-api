<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Attendee;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Event::factory()->count(5)->create();
        Attendee::factory()->count(10)->create();
    }
}
