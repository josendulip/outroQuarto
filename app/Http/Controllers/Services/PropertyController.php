<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Property;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use App\Models\VerifyService;
use App\Models\PromoService;
use App\Models\houseImages;
use App\Models\User;
use App\Models\ScheduleService;

class PropertyController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'city' => 'required',
            'type' => 'required',
            'payment_METHOD' => 'required',
            'price' => 'required',
            'room' => 'required', 
            'living_room' => 'required', 
            'kitchen' => 'required',
            'bathroom' => 'required',
        ]);
        
        $user = Auth('api')->user();
        
        $limit = time().'.'.$user->id; 
        $house_code = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);

        //dd($data);
        $image = request()->file('profile');
        $imageName = $image->getClientOriginalName();
        $imageName = time().'_'.$imageName;
        $thumbnail = $image->getClientOriginalName();
        $thumbnail= time().'_thumbnail'.$thumbnail;

        Image::make($image)
        ->fit(300, 200)
        ->save(public_path('/images/property/thumbnail/').$thumbnail);
        $image->move(public_path('/images/property/original'), $imageName);
            
        if($request->seal == 'false' ){$data['seal'] = false;}else{$data['seal'] = true;}
        if($request->state == 'false'){$data['state'] = false;}else{$data['state'] = true;}
        if($request->furniture == 'false'){$data['furniture'] = false;}else{$data['furniture'] = true;}
        //pode se usar este ou akele 
        /* $data['seal'] = $data['seal'] === 'true' ? true : false;
        $data['furniture'] = $data['furniture'] === 'true'? true : false;
        $data['state'] = $data['state'] === 'true'? true : false; */

        return Property::create([
            'house_code' => $house_code,
            'user_id' => $user->id,
            'city' => $data['city'],
            'county' => $data['county'],
            'district' => $data['district'],
            'street' => $data['street'],
            //'period' => $data['period'],
            'type' => $data['type'],
            'payment_METHOD' => $data['payment_METHOD'],
            'price' => $data['price'],
            'room' => $data['room'], 
            'living_room' => $data['living_room'], 
            'kitchen' => $data['kitchen'],
            'bathroom' => $data['bathroom'],
            'seal' => $data['seal'],
            'furniture' => $data['furniture'],
            'state' => $data['state'],
            'description' => $data['description'],
            'username'  => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'profile' => 'images/property/thumbnail/'.$thumbnail,
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
        ->save(public_path('/images/property/thumbnail/').$thumbnail);
        $image->move(public_path('/images/property/original'), $imageName);

        $img = new houseImages;
        $img->user_id = Auth::user()->id;
        $img->house_id = 1; //houseImages::announce()->id ;
        $img->house_code = 2; //houseImages::announce()->house_code;
        $img->image = '/images/property/thumbnail/'.$imageName;
        $img->thumbnail = '/images/property/original/'.$thumbnail;
        $img->save();

        return response()->json('ok');
    }

    public function VerificationHouse(Request $request){

        $data = $request->all();
        $this->validate($request,[
            'user_id' => 'required',
            'username' => 'required',
            'house_code' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'house_city' => 'required',
            'house_county' => 'required',
            'house_district' => 'required',
            'house_street' => 'required',
            'price' => 'required',
            'date' => 'required',
            'time' => 'required',
            'receipt' => 'required|mimes:jpeg,png,jpg,gif,pdf',
        ]);
        

        $user = Auth('api')->user();
        $receipt = request()->file('receipt');
        $receiptName = $receipt->getClientOriginalName();
        $receiptName = time().'_'.$receiptName;

        $receipt->move(public_path('/images/receipt/verification'), $receiptName);


        return VerifyService::create([
            'user_id' => $user->id,
            'username' => $user->name,
            'house_code' => $data['house_code'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'house_city' => $data['house_city'],
            'house_county' => $data['house_county'],
            'house_district' => $data['house_district'],
            'house_street' => $data['house_street'],
            'price' => $data['price'], 
            'date' => $data['date'], 
            'time' => $data['time'],
            'receipt' => 'images/receipt/verification/'.$receiptName,
            'request_type'=> $data['request_type'],
        ]);
    }
    public function PromotionHouse(Request $request){
        $data = $request->all();
        //dd($data);

        $this->validate($request,[
            'user_id' => 'required',
            'username' => 'required',
            'house_code' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'house_city' => 'required',
            'house_county' => 'required',
            'house_district' => 'required',
            'house_street' => 'required',
            'total_days' => 'required',
            'total_amount' => 'required',
            'receipt_promo' => 'required|mimes:jpeg,png,jpg,gif,pdf',
        ]);
        

        $user = Auth('api')->user();
        $receipt = request()->file('receipt_promo');
        $receiptName = $receipt->getClientOriginalName();
        $receiptName = time().'_'.$receiptName;

        $receipt->move(public_path('/images/receipt/promotion'), $receiptName);


        return PromoService::create([
            'user_id' => $user->id,
            'house_code' => $data['house_code'],
            'username' => $user->name,
            'phone' => $data['phone'],
            'email' => $data['email'],
            'house_city' => $data['house_city'],
            'house_county' => $data['house_county'],
            'house_district' => $data['house_district'],
            'house_street' => $data['house_street'],
            'fixed_amount_per_day' => $data['fixed_amount_per_day'], 
            'total_days' => $data['total_days'], 
            'total_amount' => $data['total_amount'],
            'receipt_promo' => 'images/receipt/promotion/'.$receiptName,
            'request_type'=> $data['request_type'],
        ]);
    }

    /* Get owner Properties */
    public function getOwnerProperty($slug){
        $user = User::where('slug', $slug)->first();

        return  $user->property()->get();
    }

    public function destroy($id)
    {
        $delete = Property::findOrFail($id);
        //delete house 
        $delete->delete();
        return ['massage' => 'deleted house'];
    }
}
