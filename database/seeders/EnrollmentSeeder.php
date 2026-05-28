<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Classes;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $students = Student::all();
        $classes = Classes::all();

        if ($students->count() > 0 && $classes->count() > 0) {
            foreach ($students as $student) {
                // Giả sử học sinh đã học 1 lớp
                $class = $classes->random();
                
                DB::table('learningprogress')->insert([
                    'studentid' => $student->studentid,
                    'classid' => $class->classid,
                    'midterm_score' => $faker->randomFloat(1, 0, 10),
                    'final_score' => $faker->randomFloat(1, 0, 10),
                    'attendance_rate' => $faker->numberBetween(50, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
