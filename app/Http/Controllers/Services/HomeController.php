<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\houseImages;

class HomeController extends Controller
{
    public function index(){
        //return Property::all();
        return Property::latest()->paginate(12);
    }

    public function getHouse($houseCode)
    {
        
        $house = Property::where('house_code', $houseCode)->first();

        //dd($house);
    
        return response()->json($house);
    }

    
    public function getPhotos($houseCode)
    {       //$src = 0; $thumb =0; $caption = 0; $way = '../';
        return houseImages::where('house_code', $houseCode)->get();
    }

    public function searchedhouses(){
        return Property::latest()->paginate(8);        
    }
    
    public function searchHouser()
    {
        if ($search = \Request::get('q')) {
            $result = Property::where(function($query) use ($search){
                $query->where('type' , 'LIKE' , '%'.$search.'%') 
                ->orWhere('price' , 'LIKE' , '%'.$search.'%')
                ->orWhere('room', 'LIKE',  '%'.$search.'%') 
                ->orWhere('city' , 'LIKE' , '%'.$search.'%');
            })->paginate(3);
        }else{
            $result = Property::latest()->paginate(5);
        }
        return $result;
    }
}
