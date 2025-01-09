<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $subjects =[
            [
                "code" => "Asignatura 1",
                "hours" => 110,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 2",
                "hours" => 120,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 3",
                "hours" => 130,
                "created_at" => now(),
            ],

            [
                "code" => "Asignatura 4",
                "hours" => 140,
                "created_at" => now(),
            ],

            [
                "code" => "Asignatura 5",
                "hours" => 150,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 6",
                "hours" => 160,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 7",
                "hours" => 170,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 8",
                "hours" => 180,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 9",
                "hours" => 190,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 10",
                "hours" => 200,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 11",
                "hours" => 210,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 12",
                "hours" => 220,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 13",
                "hours" => 230,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 14",
                "hours" => 240,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 15",
                "hours" => 250,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 16",
                "hours" => 260,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 17",
                "hours" => 270,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 18",
                "hours" => 280,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 19",
                "hours" => 290,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 20",
                "hours" => 300,
                "created_at" => now(),
            ],
            [
                "code" => "Tutoria",
                "hours" => 100,
                "created_at" => now(),
            ]
            ];
            DB::table('subjects')->insert($subjects);

    }
}
