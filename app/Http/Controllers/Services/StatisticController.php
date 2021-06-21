<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announce;
use App\Models\houseImages;

class StatisticController extends Controller
{
    public function index(){
        $user = Auth('api')->user();
        return $user->announce()->latest()->paginate(8);
    }

    public function editMyHouse($houseCode)
    {
        
        $house = Announce::where('house_code', $houseCode)->first();
        
    
        return response()->json($house);
    }
    
    public function saveViews($house)
    {
        dd($house);
    }
}
