<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {
        $history = Auth()->user()->history()->latest()->paginate(8);
        if($history)
        return $history;
    }

    public function create($houseCode)
    {
        $house_Code = Property::where('house_code', $houseCode)->first();
        //dd($house_Code);
        $user = Auth('api')->user();
        
        $house_Code->history()->create([
            'user_id' => $user->id,
            'property_id' => $house_Code->id,
            'house_code' => $house_Code->house_code,
            'status' => $house_Code->status,
            'city' => $house_Code->city,
            'county' => $house_Code->county,
            'district' => $house_Code->district,
            'street' => $house_Code->street,
            'period' => $house_Code->period,
            'type' => $house_Code->type,
            'payment_METHOD' => $house_Code->payment_METHOD,
            'price' => $house_Code->price,
            'room' => $house_Code->room, 
            'living_room' => $house_Code->living_room, 
            'kitchen' => $house_Code->kitchen,
            'bathroom' => $house_Code->bathroom,
            'seal' => $house_Code->seal,
            'furniture' => $house_Code->furniture,
            'state' => $house_Code->state,
            'state' => $house_Code->verification,
            'description' => $house_Code->description,
            'username'  => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'profile' => $house_Code->profile,
            'slug' => $house_Code->slug,
        ]);

        return "added to history";
    }

    public function dropHistory($id){
        $delete = History::findOrFail($id);
        $delete->delete();
    }
}
