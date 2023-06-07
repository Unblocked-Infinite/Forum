<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'password' => Hash::make('admin'),
                // 'avatar_url' => 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.pinimg.com%2Foriginals%2F04%2F60%2Fc9%2F0460c984313a900f87b56b07789bf3de.gif&f=1&nofb=1&ipt=55bf3fed69fed436f995e011255522754dfe25943f8d9dc88f184cba7d35a136&ipo=images',
                'is_banned' => 0,
                'role' => 'admin',
            ],
            [
                'username' => 'member',
                'password' => Hash::make('member'),
                // 'avatar_url' => 'https://i.pinimg.com/474x/65/25/a0/6525a08f1df98a2e3a545fe2ace4be47.jpg',
                'is_banned' => 0,
                'role' => 'member',
            ],
            [
                'username' => 'banned',
                'password' => Hash::make('banned'),
                // 'avatar_url' => 'https://i.pinimg.com/474x/65/25/a0/6525a08f1df98a2e3a545fe2ace4be47.jpg',
                'is_banned' => 1,
                'role' => 'member',
            ],
        ];

        $userData = [];
        $now = now();

        foreach ($users as $user) {
            $createdUser = User::create([
                'username' => $user['username'],
                'password' => $user['password'],
                'is_banned' => $user['is_banned'],
            ]);

            // Find the role for the user
            $role = Role::where('name', $user['role'])->first();

            // Attach the role to the user
            $createdUser->roles()->attach($role);
        }

        DB::table('users')->insert($userData);

        \App\Models\User::factory()->count(500)->create();
    }
}
