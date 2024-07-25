<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Иван Петров',
            'email' => 'test@test.com',
            'password' => '1234567',
        ]);

        User::factory()->create([
            'name' => 'Виктор Иванов',
            'email' => 'test2@test.com',
            'password' => '1234567',
        ]);

        User::factory()->create([
            'name' => 'Сергей Бодров',
            'email' => 'test3@test.com',
            'password' => '1234567',
        ]);
    }
}
