<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class DefaultAvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $url = 'https://i.pinimg.com/474x/65/25/a0/6525a08f1df98a2e3a545fe2ace4be47.jpg';
        $cacheKey = 'default_avatar';
        $filename = 'default_avatar.jpg';

        // Check if the image is already cached
        $imageContent = Cache::get($cacheKey);

        if (!$imageContent) {
            try {
                $imageContent = file_get_contents($url);
                // Cache the image content with an optional expiration time (e.g., 1 day)
                Cache::put($cacheKey, $imageContent, 60 * 60 * 24);
            } catch (Exception $e) {
                throw new Exception('Unable to download the default avatar image', 0, $e);
            }
        }

        // Store the image in your desired local storage directory, for example 'public/avatars'
        Storage::put('public/avatars/' . $filename, $imageContent);
    }
}
