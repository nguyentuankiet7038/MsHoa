<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $primaryKey = 'classid';

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseid', 'courseid');
    }
}
