<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'slug' => Str::uuid(),
            'name' => 'Administrator',
            'email' => 'admin@statapps.dev',
            'password' => bcrypt('@dminbps!'),
            'role' => 'admin',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'slug' => Str::uuid(),
            'name' => 'Tim IT dan Pengolahan',
            'email' => 'olah.it1800@gmail.com',
            'password' => bcrypt('it1800bps!'),
            'role' => 'user',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
