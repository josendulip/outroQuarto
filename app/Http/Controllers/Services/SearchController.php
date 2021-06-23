<?php

namespace App\Http\Controllers\services;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\houseImages;
use App\Models\HouseReview;

class SearchController extends Controller
{
    public function index(){
        ///dd($request->all());
        return Property::latest()->paginate(8);
       /*  $state = 'available';
        $jobs = Announce::where('state', $state)->latest()->paginate(8);
       
        return response()->json($jobs); */
        /* if($request->city)
        {
            return Announce::where('city', $request->city)->get();
        }elseif($request->type)
        {
            return Announce::where('city', $request->city)->get();
        } */        
    }
    public function findHouse($houseKey)
    {
        $house = Property::where('house_code', $houseKey)->first();
    
        return response()->json($house);
    }

    
    public function searchH()
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

    public function findPhotos($houseCode)
    {       //$src = 0; $thumb =0; $caption = 0; $way = '../';
        return houseImages::where('house_code', $houseCode)->get();
    }

    
    public function getTotalStars($houseCode)
    {
        $count = HouseReview::where('house_code', $houseCode)->count();
        //$count = $this->reviews()->count();
        if(empty($count)){
            return 0;
        }else{
            //$starCountSum=$this->reviews()->sum('rating');
            $starCountSum=HouseReview::where('house_code', $houseCode)->sum('rating');
            $average=$starCountSum/$count;
    
           return $average;

        }
    }
}
