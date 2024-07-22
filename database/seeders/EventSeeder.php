<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
