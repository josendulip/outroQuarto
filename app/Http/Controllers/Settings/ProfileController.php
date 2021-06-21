<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        return tap($user)->update($request->only('name', 'email'));
    }

    public function uploadPhoto(Request $request)
    {
        $user = $request->user();
        //$user = Auth('api')->user();
        //dd($user);
        $this->validate($request, [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if($user){            
            File::delete([
                public_path($user->photo),
            ]);
        }
        $image = request()->file('photo');
        $imageName = $image->getClientOriginalName();
        $imageName = time().'_'.$imageName;
        $thumbnail = $image->getClientOriginalName();
        $thumbnail= time().'_thumbnail'.$thumbnail;

        Image::make($image)
        ->fit(200, 200)
        ->save(public_path('images/profile/thumbnail/').$thumbnail);
        $image->move(public_path('images/profile/original/'), $imageName);

        $folder = '/images/profile/thumbnail/'.$thumbnail;
        /* $result = $user->update([
            'photo' => $folder,
        ]); */
        $result = User::where('id', $user->id)
                ->update([
                    'photo' => $folder,
                ]);

        return response()->json($result);
        //return tap($user)->update($request->only('name', 'email'));
    }
    public function uploadInfo(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            //'password' => 'required',
            'identity' => 'required',
            'birth' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        return tap($user)->update($request->all());
    }
    public function becomeAdvertiser(Request $request)
    {        
        $user = $request->user();
        $this->validate($request, [
            'name' => 'required',
            'identity' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'role' => 'required',
            'activity' => 'required',
        ]);
        //dd($request->all());
        return tap($user)->update($request->all());
    }
}
