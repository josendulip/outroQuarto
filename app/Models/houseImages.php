<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class houseImages extends Model
{
    use HasFactory;

    protected $filiable = ['user_id', 'house_id', 'house_code', 'src', 'thumb', 'caption', 'src_src',
    'src_thumb'];

    
    
    public function property()
    {
        return $this->belongsTo(Property::class);

    }
}
