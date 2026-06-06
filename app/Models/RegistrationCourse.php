<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationCourse extends Model
{
    use HasFactory;

    protected $primaryKey = 'registrationid';

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid', 'studentid');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classid', 'classid');
    }
}
