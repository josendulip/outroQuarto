<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\houseImages;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Auth;
use Carbon\Carbon;
use App\Models\Favourite;

class MyHousesController extends Controller
{
    public function index(){
        $user = Auth('api')->user();
        return $user->property()->latest()->paginate(8);
    }

    public function hasPhotos($house){
        $user = Auth('api')->user();
        $houses = $user->property()->get();

        /* $collection = collect([
            ['product_id' => 'prod-100', 'name' => 'Desk'],
            ['product_id' => 'prod-200', 'name' => 'Chair'],
        ]);
        
        $plucked = $collection->pluck('name');
        
        $plucked->all(); */
    
        //dd($getH);
        return houseImages::where('house_code', $house)->first();
        //dd($house);
        //return $house->houseimages()->first();

    }

    public function editMyHouse($houseCode)
    {
        
        $house = Property::where('house_code', $houseCode)->first();
        /* !!$house->state; 
        !!$house->seal; */
        //dd($house);
        $house_cod = houseImages::where('house_code', $house->house_code)->first();
        if(!$house_cod){
            $house_id = Property::where('house_code', $house->house_code)->first();
            $has="hasnot";
            $house_id->update(['add_images' => $has]);
        }
    
        return response()->json($house);
    }

    
    public function getHouse($houseCode)
    {
        
        $house = Property::where('house_code', $houseCode)->first();

        //dd($house);
    
        return response()->json($house);
    }

    public function updateMyHouse(Request $request, $houseCode)
    {
        $data = $request->all();
        $houseCode =  Property::where('house_code', $houseCode)->first();
        /* dd($houseCode);
        $grade->update(['grade' => "graduated"]); */
        
        $result = $houseCode->update($data);
        return $result;
    }
    public function changeProfileHousePicture(Request $request)
    {
        //dd($request->all());
        //$data = $request->all();
        $houseCode = Property::where('house_code', $request->house_code)->first();

        if($houseCode){
            //$oldimage = Announce::where('house_code', $houseCode)->firstOrFail();
            File::delete([
                public_path($houseCode->profile),
                //public_path('images/announce/original/'.$houseCode->profile),
                //public_path($houseCode->thumbnail),
            ]);
            //$houseCode->delete();
        }
        /* $currentPhoto = $user->photo; // vem do database essa foto
        if($request->photo != $currentPhoto){ // $request->photo vem do form 
            $name = time().'.' .explode('/', explode(':', substr($request->photo, 0, strpos ($request->photo, ';')))[1])[1]; ///este codigo eh para encontrarmos um nome p/ a imagem 
            \Image::make($request->photo)->save(public_path('img/profile/').$name);

            $request->merge(['photo'=> $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto; //serve para guardar a imagem atual do usuario
            if (file_exists($userPhoto)) {

                @unlink($userPhoto); // ira apagar imagem do cliente
            }
        } */

        $image = request()->file('profile');
        $imageName = $image->getClientOriginalName();
        $imageName = time().'_'.$imageName;
        $thumbnail = $image->getClientOriginalName();
        $thumbnail= time().'_thumbnail'.$thumbnail;

        Image::make($image)
        ->fit(200, 200)
        ->save(public_path('images/property/thumbnail/').$thumbnail);
        $image->move(public_path('images/property/original/'), $imageName);

        $folder = 'images/property/thumbnail/'.$thumbnail;
        //dd($houseCode);
        //$houseCode->update(['profile' => $folder]);
        $result = $houseCode->update([
            'profile' => $folder,
        ]);
        
        if($houseCode){
            $houseCode->favourite()->update([
                'profile' => $folder,
            ]);
        }
        
        return response()->json($result);
    }

    public function uploadPhotos(Request $request)
    {
        try {
            $data=$request->all();        

            $house_id = Property::where('house_code', $request->house_code)->first();
            //$attachments = $this->processAttachments($request);
            
            if (count($request->file('attachments')) > 0) {
                
                foreach($request->file('attachments') as $value)
                {
                    $imageName = $value->getClientOriginalName();
                    $imageName = time().'_original'.$imageName;
                    $thumbnail = $value->getClientOriginalName();
                    $thumbnail= time().'_thumb'.$thumbnail;

                    Image::make($value)
                    ->fit(100, 100)
                    ->save(public_path('/images/property/thumbnail/').$thumbnail);
                    $value->move(public_path('/images/property/original'), $imageName);

                    $imageArray = array(

                        'user_id'=>  Auth::user()->id,
                        'house_id'=> $house_id->id ,
                        'house_code'=>  $data['house_code'],
                        //'photos' => $request->attachments[$key],
                        'src' => '../images/property/original/'.$imageName,
                        'thumb' => '../images/property/thumbnail/'.$thumbnail,
                        'src_src' => 'images/property/original/'.$imageName,
                        'src_thumb' => 'images/property/thumbnail/'.$thumbnail,
                        'caption' => $value->getClientOriginalName(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ); 

                    houseImages::insert($imageArray);    

                } 
                $has = 'has';
                $house_id->update(['add_images' => $has]);
            }

    		return response()->json(array(
                'success' => true,
                'data' => [],
                'errors' => []
            ), 200);

    	} catch(\Exception $e) {
    		return response()->json(array(
                'success' => false,
                'data' => 'Server error happened',
                'errors' => $e
            ), 200);
        }    

        return response()->json('ok');
    }
    
    /* public function getPhotos($houseCode)
    {       //$src = 0; $thumb =0; $caption = 0; $way = '../';
        return houseImages::where('house_code', $houseCode)->get(['src', 'thumb', 'caption']);
    } */
    
    public function destroy($id)
    {

        $del = houseImages::findOrFail($id);
        //$user = Auth('api')->user();
        if($del){
            //$oldimage = houseImages::where('id', $del)->firstOrFail();
        
            $house_cod = houseImages::where('house_code', $del->house_code)->first();
            
            if(!$house_cod){
                $house_id = Property::where('house_code', $house_cod->house_code)->first();
                $has="hasnot";
                $house_id->update(['add_images' => $has]);
            }

            File::delete([
                public_path($del->src_src),
                public_path($del->src_thumb),
            ]);
            $del->delete();
        }
    }
}
