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
        ])->assignRole('god');

        User::factory(20)->create([
            'user_type' => 'teacher',
        ])->each(function ($user) {
            $user->assignRole('teacher');
        });

        User::factory(5)->create([
            'user_type' => 'admin',
        ])->each(function ($user) {
            $user->assignRole('admin');
        });

        User::factory(50)->create([
            'user_type' => 'student',
        ]);

    }
}
