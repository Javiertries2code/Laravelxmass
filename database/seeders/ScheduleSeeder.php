<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;



class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = User::where('type_user', 'teacher')->get();
        $courses = collect();
        foreach($teachers as $teacher){
            $courses = Course::all()->shuffle()->take(3);



        }






    }
}
