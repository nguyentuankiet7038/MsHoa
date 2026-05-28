<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
            for ($i = 1; $i <= 10; $i++) {
                Course::create([
                    'coursename' => 'Khóa học tiếng Anh ' . fake()->word(),
                    'description' => fake()->paragraph(),
                    'level' => fake()->randomElement(['A1', 'A2', 'B1', 'B2', 'C1', 'C2']),
                    'status' => fake()->randomElement(['active', 'inactive']),
                    // Lấy ảnh ngẫu nhiên từ mạng
                    'image' => 'https://picsum.photos/400/250?random=' . $i, 
                    // Giá random từ 500k đến 2 triệu VNĐ
                    'price' => fake()->numberBetween(500000, 2000000),
                ]);
            }
        
    }
}
