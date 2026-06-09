<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationCourse extends Model
{
    use HasFactory;

    protected $primaryKey = 'registrationid';

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classid', 'classid');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid', 'studentid');
    }

    protected $fillable = [
        'studentid',
        'classid',
        'registration_date',
        'status',
    ];
}
