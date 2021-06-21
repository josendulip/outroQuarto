<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoService extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'house_code',
        'username',
        'phone',
        'email',
        'house_city',
        'house_county',
        'house_district',
        'house_street',
        'fixed_amount_per_day',
        'total_days',
        'total_amount',
        'receipt_promo',
        'request_type',
        'description',
        ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
