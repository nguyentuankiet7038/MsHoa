<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
       $faker = \Faker\Factory::create();
       
       // Tạo 1 admin
       User::create([
           'fullname' => 'Admin User',
           'email' => 'admin@gmail.com',
           'password' => bcrypt('password'),
           'role' => 'admin',
           'phone' => '0123456789'
       ]);

       // Tạo 2 consultant
       foreach (range(1, 2) as $index) {
           User::create([
               'fullname' => $faker->name,
               'email' => 'consultant' . $index . '@gmail.com',
               'password' => bcrypt('password'),
               'role' => 'consultant',
               'phone' => $faker->phoneNumber
           ]);
       }

       // Tạo 5 giáo viên
       foreach (range(1, 5) as $index) {
           User::create([
               'fullname' => $faker->name,
               'email' => 'teacher' . $index . '@gmail.com',
               'password' => bcrypt('password'),
               'role' => 'teacher',
               'phone' => $faker->phoneNumber
           ]);
       }

       // Tạo 10 học sinh
       foreach (range(1, 10) as $index) {
           User::create([
               'fullname' => $faker->name,
               'email' => 'student' . $index . '@gmail.com',
               'password' => bcrypt('password'),
               'role' => 'student',
               'phone' => $faker->phoneNumber
           ]);
       }
   }
}