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
                "hours" => 125,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 2",
                "hours" => 97,
                "created_at" => now(),
            ],
            [
                "code" => "Asignatura 3",
                "hours" => 97,
                "created_at" => now(),
            ],

            [
                "code" => "Asignatura 4",
                "hours" => 97,
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
                "code" => "Tutoria",
                "hours" => 170,
                "created_at" => now(),
            ]
            ];
            DB::table('subjects')->insert($subjects);

    }
}
