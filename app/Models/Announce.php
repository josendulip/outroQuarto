<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announce extends Model
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
        'price',
        'room',
        'living_room',
        'kitchen',
        'bathroom',
        'garden',
        'furniture',
        'state',
        'description',
        'email',
        'phone',
        'profile'
    ];

    //protected $table = 'languages';

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
    
    /* public function getStarRating()
    {
        $count = $this->reviews()->count();
        if(empty($count)){
            return 0;
        }
        $starCountSum=$this->reviews()->sum('rating');
        $average=$starCountSum/ $count;

       return $average;

    } */
}
