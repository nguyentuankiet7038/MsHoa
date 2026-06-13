<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningProgress extends Model
{
    use HasFactory;

    protected $table = 'learningprogress';
    protected $primaryKey = 'progressid';

    protected $fillable = [
        'studentid',
        'classid',
        'midterm_score',
        'final_score',
        'attendance_rate',
        'is_blocked'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid', 'studentid');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classid', 'classid');
    }
}
