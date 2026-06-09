<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $primaryKey = 'classid';

    protected $fillable = [
        'classname',
        'courseid',
        'teacherid',
        'start_date',
        'end_date',
        'schedule',
    ];

    /**
     * Relationship with Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'courseid', 'courseid');
    }

    /**
     * Relationship with Teacher
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacherid', 'teacherid');
    }

    /**
     * Relationship with RegistrationCourse (Students in this class)
     */
    public function registrations()
    {
        return $this->hasMany(RegistrationCourse::class, 'classid', 'classid');
    }
}
