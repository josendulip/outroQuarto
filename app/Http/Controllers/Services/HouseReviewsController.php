<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HouseReview;
use App\Models\Property;
use App\Models\User;

class HouseReviewsController extends Controller
{
    private $housereview;

    public function __construct(HouseReview $housereview)
    {
        $this->middleware('auth:api'); 
		$this->housereview = $housereview;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $user = Auth('api')->user()->id;
        $house_code = Auth('api')->user()->review()->house_code;
        $house_id = Auth('api')->user()->review()->house_id; */
        
        //return HouseReview::where(['user_id'=> $user, 'house_id'=> $house_id, 'house_code'=> $house_code])->get(); 
        return HouseReview::latest()->get();
        //return auth('api')->user()->review()->get();
    }


    public function getReview($house_code){

        $user = Auth('api')->user(); 
        $reviews = HouseReview::where(['user_id' => $user->id, 'house_code' => $house_code])->first();
        if(empty($reviews)){
            return 0;
        }
        return $reviews;
    }


    public function getStarRating($house_code)
    {
        $count = HouseReview::where('house_code', $house_code)->count();
        //$count = $this->reviews()->count();
        if(empty($count)){
            return 0;
        }
        //$starCountSum=$this->reviews()->sum('rating');
        $starCountSum=HouseReview::where('house_code', $house_code)->sum('rating');
        $average=$starCountSum/$count;

       return $average;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth('api')->user();
        $house = Property::where('house_code', $request->house_code)->first();
        //auth(api')->user()->announce()->id
        $data['house_id'] = $house->id;
        $data['user_name'] = $user->name;
        //$data['house_code'] = $house->house_code;
        //dd($data);
        $user2=HouseReview::where('house_code', $request->house_code)->first();
        if(empty($user2->user_id)){            
            $user->review()->create($data);                
        }else{            
            if($user->id != $user2->user_id){
                $user->review()->create($data);
            }else{
                return ['massage' => 'You have rated already'];
            }
        }
        
        //auth()->user()->review()->create($data);

        return response()->json('Done');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $house_code)
    {
        $data = $request->all();
        //dd($data);
        $user = auth('api')->user();
        //$review = $this->housereview->find($house_code);
        $review = HouseReview::where(['house_code'=> $house_code,  'user_id'=>$user->id])->first();
        //dd($review);
        
        $review->update($data);    

        return ["massage" => "Done"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
