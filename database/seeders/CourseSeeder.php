<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course;


class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $list_subjects = [
            ['code' => 'curso 1', 'name' => "DAM"],
            ['code' => 'curso 2', 'name' => "DAO"],
            ['code' => 'curso 3', 'name' => "Sistemas"],
            ['code' => 'curso 4"', 'name' => "WEB"]
        ];

        DB::table('courses')->insert($list_subjects);



    }
}
