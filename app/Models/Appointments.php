<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $fillable = [    
        'house_code',    
        'name',
        'identity',
        'address',
        'phone',
        'email',
        'date',
        'time',
        'payment',
        'service',
        'card_number',
        'validation',
        'period'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
