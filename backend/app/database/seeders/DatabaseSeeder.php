<?php

namespace Database\Seeders;

use App\Models\AppUser;
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

        $user = AppUser::firstOrNew(['id' => 1]);
        $user->name = 'Admin';
        $user->email = 'main@grr.la';
        $user->password = 'main@grr.la';
        $user->save();
    }
}
