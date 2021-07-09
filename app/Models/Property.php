<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
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
        'seal',
        'furniture',
        'state',
        'width',
        'length',
        'area',
        'description',
        'username',
        'email',
        'phone',
        'profile',
        'add_images'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function houseimages()
    {
        return $this->hasMany(houseImages::class);

    }

    public function reviews()
    {
        return $this->hasMany(HouseReview::class);
    }
    public function favourite()
    {
        return $this->hasMany(Favourite::class); 
    }
    public function history()
    {
        return $this->hasMany(History::class); 
    }
}
