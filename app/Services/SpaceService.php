<?php

namespace App\Services;
use App\Models\Space;
use App\Models\SpaceImage;
use App\Models\SpaceAvailability;
use Illuminate\Support\Facades\Storage;

class SpaceService
{
    public function storeSpaceImages(array $images, $space_id): void
    {
        $space = Space::find($space_id);

        foreach ($images as $image) {
            $path = $image->store('space_images', 'public');

            SpaceImage::create([
                'space_id' => $space->id,
                'image_url' => $path,
                'caption' => $space->title
            ]);
        }
    }

    public function storeSpaceAmenities(array $amenities, $space_id): void
    {
        $space = Space::find($space_id);

        if ($space->amenities()->count() > 0) {
            $space->amenities()->detach();
        }
        $space->amenities()->attach($amenities);
    }

    public function storeSpaceAvailabilities(array $availabilities, $space_id): void
    {
        $space = Space::find($space_id);

        if ($space->availability()->count() > 0) {
            $spaceAvailabilities = SpaceAvailability::where('space_id', $space->id)->get();
            foreach ($spaceAvailabilities as $spaceAvailability) {
                $spaceAvailability->delete();
            }
        }

        foreach ($availabilities as $day => $data) {
            if (isset($data['is_available'])) {
                SpaceAvailability::create([
                    'space_id' => $space->id,
                    'day_of_week' => $day,
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                    'is_available' => true,
                ]);
            }
        }
    }

    public function deleteSpaceImages(array $images_id, $space_id): void
    {
        $space = Space::find($space_id);

        foreach ($images_id as $imageId) {
            $image = SpaceImage::findOrFail($imageId);
            if ($image) {
                Storage::delete($image->image_url);
                $image->delete();
            }
        }
    }
}