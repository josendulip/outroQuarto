<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    use HasFactory;

    protected $fillable = [
        'yourname',
        'youraddress',
        'yourphone',
        'ownername',
        'owneraddress',
        'ownerphone',
        'status',
    ];
}
