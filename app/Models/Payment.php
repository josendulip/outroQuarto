<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'id_transation',
        'username',
        'identity',
        'phone',
        'email',
        'user_address',
        'user_city',
        'user_country',
        'user_photo',
        'iban',
        'slug',
        'house_code',
        'house_city',
        'house_county',
        'house_district',
        'house_street',
        'paid_user_id',
        'paid_user_name',
        'paid_user_email',
        'paid_user_phone',
        'paid_user_address',
        'paid_amount',
        'paid_receipt',
        'paid_date',
        'percentage',
        'outroQuarto_amount',
        'trans_method',
        'receipt',
        'service',
        'description',
        'status',
        'manager',
        'manager_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
