<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feedback;


class feedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         Feedback::insert([
            [
                'studentid' => 1,
                'courseid' => 1,
                'classid' => 1,
                'ratingscore' => 5,
                'comment' => 'Khóa học rất hữu ích',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'studentid' => 2,
                'courseid' => 1,
                'classid' => 1,
                'ratingscore' => 4,
                'comment' => 'Giảng viên nhiệt tình',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'studentid' => 3,
                'courseid' => 2,
                'classid' => 2,
                'ratingscore' => 5,
                'comment' => 'Nội dung thực tế và dễ hiểu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
