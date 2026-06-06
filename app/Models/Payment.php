<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'paymentid';

    protected $fillable = [
        'registrationid',
        'amount',
        'paymentmethod',
        'paymentdate',
        'status',
    ];

    protected $casts = [
        'paymentdate' => 'datetime',
    ];

    public function registration()
    {
        return $this->belongsTo(RegistrationCourse::class, 'registrationid', 'registrationid');
    }
}
