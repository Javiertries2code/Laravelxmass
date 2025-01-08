<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Subject;

class RandomCourseSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        //I did this as to avoid taking 'tutoria', this will be assigned manually y admin, but by now i keep
        //in the list of subjects, so it can be placed in the selector.
        $subjects = Subject::where('code', '!=', 'Tutoria')->get();

        // This should add subject to every course, randomle,
        //gonna make a manual assignment anyways, for the sake of stability
        $courses->each(function ($course) use ($subjects) {
            // its gonna take betwwen  4 to 5 subjects for every course, random way
            $randomSubjects = $subjects->random(rand(4, 5))->pluck('id')->toArray();
            $course->subjects()->attach($randomSubjects);
        });
    }
}
