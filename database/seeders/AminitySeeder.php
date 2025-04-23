<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AminitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            ['name' => 'Projector', 'icon' => 'fa-solid fa-video'],
            ['name' => 'Whiteboard', 'icon' => 'fa-solid fa-chalkboard'],
            ['name' => 'High-speed Wi-Fi', 'icon' => 'fa-solid fa-wifi'],
            ['name' => 'Air Conditioning', 'icon' => 'fa-solid fa-fan'],
            ['name' => 'Video Conferencing', 'icon' => 'fa-solid fa-video-camera'],
            ['name' => 'Coffee / Tea', 'icon' => 'fa-solid fa-mug-hot'],
            ['name' => 'Parking Available', 'icon' => 'fa-solid fa-parking'],
            ['name' => 'Office Supplies', 'icon' => 'fa-solid fa-pen'],
            ['name' => 'Ergonomic Chairs', 'icon' => 'fa-solid fa-chair'],
            ['name' => 'Power Outlets', 'icon' => 'fa-solid fa-plug']
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}
