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
        // Lặp 5 lần để tạo 5 user giả
       foreach (range(1, 5) as $index) {
           User::create([
               'fullname' => $faker->userName,
               'email' => $faker->email,
               'password' => bcrypt('secret')
           ]);
       }
   }
}