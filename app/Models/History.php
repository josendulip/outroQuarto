<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'house_code',
        'city',
        'county',
        'district',
        'street',
        'type',
        'period',
        'payment_METHOD',
        'contrat_type',
        'price',
        'tax_visit',
        'room',
        'living_room',
        'kitchen',
        'bathroom',
        'width',
        'length',
        'area',
        'seal',
        'furniture',
        'state',
        'description',
        'verification',
        'promo',
        'username',
        'email',
        'phone',
        'add_images',
        'profile',
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
