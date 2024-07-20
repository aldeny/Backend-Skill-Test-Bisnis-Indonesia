<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Category::create([
            'category_name' => 'Konser',
        ]);

        Category::create([
            'category_name' => 'Seminar',
        ]);

        Event::create([
            'event_name' => 'Event A',
            'location' => 'Aceh',
            'province_id' => 1,
            'category_id' => 1,
            'description' => 'Event A',
            'information' => 'Event A',
            'image' => 'image.jpg',
            'start_date' => '2022-01-01 00:00:00',
            'end_date' => '2022-01-01 00:00:00',
        ]);
    }
}
