<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'God',
            'surname' => 'God',
            'email' => 'god@god.com',
            'password' => bcrypt('god'),
            'user_type' => 'God',
            'photo'=> null
        ]);

        User::factory()->create([
            'name' => 'Test User2',
            'surname' => 'Test User surname',
            'email' => 'test@example2.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin',
            'photo'=> null
        ]);

        User::factory(20)->create([
            'user_type' => 'teacher'
        ]);

        User::factory(50)->create([
            'user_type' => 'student',
        ]);

    }
}
