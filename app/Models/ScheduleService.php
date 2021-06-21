<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleService extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'house_code',
        'username',
        'phone',
        'email',
        'address',
        'house_city',
        'house_county',
        'house_district',
        'house_street',
        'price',
        'date',
        'time',
        'receipt',
        'request_type',
        'description',
        'owner',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
