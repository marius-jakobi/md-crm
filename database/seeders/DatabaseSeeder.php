<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 pseudo users
        User::factory(10)->create();

        // Create a test user with fixed values
        $testUser = new User([
            'email' => 'bob@test.com',
            'firstname' => 'Bob',
            'lastname' => 'Tester',
            'password' => Hash::make('password')
        ]);
        $testUser->save();

        // Call additional seeders
        $this->call([
            CustomerSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
