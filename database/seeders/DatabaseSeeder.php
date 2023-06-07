<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DefaultAvatarSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            TopicSeeder::class,
            TagSeeder::class,
            AwardSeeder::class,
            GroupSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
