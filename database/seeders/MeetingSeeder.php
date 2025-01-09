<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = User::where('email', 'like', '%@javierFactory.com')->where('user_type', 'teacher')->pluck('id');
        $students = User::where('user_type', 'student')->pluck('id');

        $teachers =  $teachers->shuffle()->take(5);
        $students =  $students->shuffle()->take(5);

        

    }
}
