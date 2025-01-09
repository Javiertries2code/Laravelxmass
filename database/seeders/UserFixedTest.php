<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserFixedTest extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Luis', 'María', 'José', 'Ana', 'Carlos', 'Laura', 'Miguel', 'Sara', 'Juan', 'Elena'];
        $surnames = ['García', 'López', 'Martínez', 'Pérez', 'González', 'Rodríguez', 'Sánchez', 'Ramírez', 'Torres', 'Hernández'];

        $users = [];

        for ($i = 1; $i <= 10; $i++) {
            $users[] = [
                'name' => $names[array_rand($names)],
                'surname' => $surnames[array_rand($surnames)] . ' ' . $surnames[array_rand($surnames)],
                'email' => 'user' . $i . '@javierFactory.com',
                'password' => bcrypt('password'),
                'telephone1' => $i.$i.$i.$i.$i,
                'telephone2' =>  $i.$i.$i.$i.$i,
                'user_type' => 'student',
                'photo' => null,
                'registration_id' => null,
                'meeting_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($users);
    }
}
