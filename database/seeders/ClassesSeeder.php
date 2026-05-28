<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Classes;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $courses = Course::all();
        $teachers = Teacher::all();

        if ($courses->count() > 0 && $teachers->count() > 0) {
            foreach (range(1, 15) as $index) {
                Classes::create([
                    'classname' => 'Class ' . $faker->bothify('??-###'),
                    'courseid' => $courses->random()->courseid,
                    'teacherid' => $teachers->random()->teacherid,
                    'start_date' => $faker->dateTimeBetween('-1 month', '+1 month'),
                    'end_date' => $faker->dateTimeBetween('+2 months', '+4 months'),
                    'schedule' => $faker->randomElement(['Mon-Wed-Fri 08:00-10:00', 'Tue-Thu-Sat 14:00-16:00', 'Mon-Fri 18:00-20:00'])
                ]);
            }
        }
    }
}
