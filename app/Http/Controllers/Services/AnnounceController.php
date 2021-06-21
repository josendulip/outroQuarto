<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announce;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use App\Models\houseImages;

class AnnounceController extends Controller
{
    
    public function create(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'city' => 'required',
            'period' => 'required',
            'type' => 'required',
            'payment_METHOD' => 'required',
            'price' => 'required',
            'room' => 'required', 
            'living_room' => 'required', 
            'kitchen' => 'required',
            'bathroom' => 'required',
            'garden' => 'required',
            'furniture' => 'required',
            'state' => 'required',
        ]);
        //dd($request);
        $user = Auth('api')->user();
        //return $user->announce()->create($data); 
        $limit = time().'.'.$user->id; 
        $house_code = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);


        $image = request()->file('profile');
        $imageName = $image->getClientOriginalName();
        $imageName = time().'_'.$imageName;
        $thumbnail = $image->getClientOriginalName();
        $thumbnail= time().'_thumbnail'.$thumbnail;

        Image::make($image)
        ->fit(200, 200)
        ->save(public_path('/images/announce/thumbnail/').$thumbnail);
        $image->move(public_path('/images/announce/original'), $imageName);


        return Announce::create([
            'house_code' => $house_code,
            'user_id' => $user->id,
            'city' => $data['city'],
            'county' => $data['county'],
            'district' => $data['district'],
            'street' => $data['street'],
            'period' => $data['period'],
            'type' => $data['type'],
            'payment_METHOD' => $data['payment_METHOD'],
            'price' => $data['price'],
            'room' => $data['room'], 
            'living_room' => $data['living_room'], 
            'kitchen' => $data['kitchen'],
            'bathroom' => $data['bathroom'],
            'garden' => $data['garden'],
            'furniture' => $data['furniture'],
            'state' => $data['state'],
            'description' => $data['description'],
            'email' => $user->email,
            'phone' => $user->phone,
            'profile' => 'images/announce/thumbnail/'.$thumbnail,
        ]);
    }

    public function storeImage(Request $request)
    {
        $this->validate($request,[
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        dd($request->all());
        //$user = Auth('api')->user();
        /* if(Auth::user()->userprofile){
            $oldimage = Userprofile::where('user_id', Auth::user()->id)->firstOrFail();
            File::delete([
                public_path($oldimage->image),
                public_path($oldimage->thumbnail),
            ]);
            $oldimage->delete();
        } */
        
        $image = request()->file('image');
        $imageName = $image->getClientOriginalName();
        $imageName = time().'_'.$imageName;
        $thumbnail = $image->getClientOriginalName();
        $thumbnail= time().'_thumbnail'.$thumbnail;

        Image::make($image)
        ->fit(100, 100)
        ->save(public_path('/images/announce/thumbnail/').$thumbnail);
        $image->move(public_path('/images/announce/original'), $imageName);

        $img = new houseImages;
        $img->user_id = Auth::user()->id;
        $img->house_id = 1; //houseImages::announce()->id ;
        $img->house_code = 2; //houseImages::announce()->house_code;
        $img->image = '/images/announce/thumbnail/'.$imageName;
        $img->thumbnail = '/images/announce/original/'.$thumbnail;
        $img->save();

        return response()->json('ok');
    }

}
