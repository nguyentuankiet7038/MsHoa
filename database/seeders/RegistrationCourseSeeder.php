<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Student;
use App\Models\Classes;
use App\Models\RegistrationCourse;

class RegistrationCourseSeeder extends Seeder
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
                // Mỗi học sinh đăng ký 1-2 lớp
                $numClasses = rand(1, 2);
                $selectedClasses = $classes->random($numClasses);
                
                foreach ($selectedClasses as $class) {
                    RegistrationCourse::create([
                        'studentid' => $student->studentid,
                        'classid' => $class->classid,
                        'registration_date' => $faker->dateTimeBetween('-2 months', 'now'),
                        'status' => $faker->randomElement(['pending', 'approved', 'rejected', 'canceled'])
                    ]);
                }
            }
        }
    }
}
