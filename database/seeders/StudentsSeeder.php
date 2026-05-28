<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Student;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $studentUsers = User::where('role', 'student')->get();

        foreach ($studentUsers as $user) {
            Student::create([
                'studentname' => $user->fullname,
                'userid' => $user->userid,
                'dateofbirth' => $faker->date('Y-m-d', '-10 years'),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'address' => $faker->address,
                'parentname' => $faker->name,
                'parentphone' => $faker->phoneNumber
            ]);
        }
    }
}
