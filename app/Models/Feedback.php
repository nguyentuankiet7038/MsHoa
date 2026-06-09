<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $primaryKey = 'feedbackid';

    protected $fillable = [
        'studentid',
        'courseid',
        'classid',
        'ratingscore',
        'comment',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseid');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classid');
    }
}