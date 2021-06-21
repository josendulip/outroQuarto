<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'house_code',
        'user_name',
        'description', 
        'rating'
    ];    
   
    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
