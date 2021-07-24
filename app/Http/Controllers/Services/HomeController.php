<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\houseImages;
use App\Models\History;

class HomeController extends Controller
{
    public function index(){
        //return Property::all();
        return Property::paginate(24);
    }
    public function homeRecentsHouses(){
        return Property::take(4)->latest()->get();
    }
    public function homeMoreVisiblesHouses(){
        return History::all()->take(4);
    }
    public function homeTopFourHouses(){
        $promo = 1;
        return Property::where('promo', $promo)->take(4)->get();
    }
    public function homeTopFourVeryHouses(){
        $vefy = 1;
        return Property::where('verification', $vefy)->take(4)->get();
    }
    public function homeRecentLands(){
        $land = 'Land';
        return Property::where('type', $land)->take(4)->latest()->get();
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
