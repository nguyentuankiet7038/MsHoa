<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Teacher;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $teachers = User::where('role', 'teacher')->get();

        foreach ($teachers as $user) {
            Teacher::create([
                'userid' => $user->userid,
                'specialy' => $faker->randomElement(['IELTS', 'TOEIC', 'General English', 'Business English']),
                'qualification' => $faker->randomElement(['Bachelor', 'Master', 'PhD']),
                'expertise' => $faker->sentence()
            ]);
        }
    }
}
