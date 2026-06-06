<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'studentid';

    protected $fillable = [
        'studentname',
        'userid',
        'dateofbirth',
        'gender',
        'address',
        'parentname',
        'parentphone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }
}
