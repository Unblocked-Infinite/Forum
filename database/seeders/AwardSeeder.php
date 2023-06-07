<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('awards')->insert([
        //     'award_name' => "Flame",
        //     'award_description' => "HQ Poster",
        //     'award_icon' => "https://i.imgur.com/h3J3vMU.png",
        //     'created_at' => now(),
        // ]);

        // DB::table('awards')->insert([
        //     'award_name' => "Wealthy",
        //     'award_description' => "Private Award.",
        //     'award_icon' => "https://i.imgur.com/3er1n7d.png",
        //     'created_at' => now(),
        // ]);

        // DB::table('awards')->insert([
        //     'award_name' => "Staff",
        //     'award_description' => "Official Staff Member",
        //     'award_icon' => "https://i.imgur.com/gNFsfmS.png",
        //     'created_at' => now(),
        // ]);

        // DB::table('awards')->insert([
        //     'award_name' => "Ruby",
        //     'award_description' => "Rare Award",
        //     'award_icon' => "https://i.imgur.com/9vL0r9k.png",
        //     'created_at' => now(),
        // ]);

        // DB::table('awards')->insert([
        //     'award_name' => "Trident",
        //     'award_description' => "Private Award.",
        //     'award_icon' => "https://i.imgur.com/xVPWxI8.png",
        //     'created_at' => now(),
        // ]);

        // DB::table('awards')->insert([
        //     'award_name' => "Bitcoin",
        //     'award_description' => "Donate $10 to obtain this award.",
        //     'award_icon' => "https://i.imgur.com/iDSHLw1.png",
        //     'created_at' => now(),
        // ]);

        // DB::table('awards')->insert([
        //     'award_name' => "Release Day",
        //     'award_description' => "Join us within our first day of release.",
        //     'award_icon' => "https://i.imgur.com/JFvpMMJ.png",
        //     'created_at' => now(),
        // ]);

        // DB::table('awards')->insert([
        //     'award_name' => "Blackhat",
        //     'award_description' => "Hacker man.",
        //     'award_icon' => "https://i.imgur.com/Kw0WbJk.png",
        //     'created_at' => now(),
        // ]);

        // DB::table('awards')->insert([
        //     'award_name' => "Gift",
        //     'award_description' => "Gift to another user for $5.",
        //     'award_icon' => "https://i.imgur.com/7mtcP8q.png",
        //     'created_at' => now(),
        // ]);

        $awards = [
            [
                'name' => "Flame",
                'description' => "HQ Poster",
                'icon' => "https://i.imgur.com/h3J3vMU.png",
                'created_at' => now(),
            ],
            [
                'name' => "Wealthy",
                'description' => "Private Award.",
                'icon' => "https://i.imgur.com/3er1n7d.png",
                'created_at' => now(),
            ],
            [
                'name' => "Staff",
                'description' => "Official Staff Member",
                'icon' => "https://i.imgur.com/gNFsfmS.png",
                'created_at' => now(),
            ],
        ];

        $now = now();
        $awardData = [];

        foreach ($awards as $award) {
            $imagePath = $this->storeImage($award['icon']);

            $awardData[] = [
                'name' => $award['name'],
                'description' => $award['description'],
                'icon' => $imagePath,
                'created_at' => $now,
            ];
        }

        DB::table('awards')->insert($awardData);
    }

    private function storeImage($imageUrl)
    {
        $imageName = basename($imageUrl);
        $imagePath = 'public/awards/' . $imageName; // Add the 'public' prefix to the path

        // Check if the image is already cached
        if (Cache::has($imagePath)) {
            return Cache::get($imagePath);
        }

        $imageContent = file_get_contents($imageUrl);

        Storage::put($imagePath, $imageContent);

        // Cache the image path for a specific duration (e.g., 1 day)
        $cacheDuration = 60 * 24;
        Cache::put($imagePath, $imagePath, $cacheDuration);

        return $imagePath;
    }
}
