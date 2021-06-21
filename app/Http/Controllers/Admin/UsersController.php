<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->get();
    }

    public function getUserInfor($slug)
    {
        $user = User::where('slug', $slug)->first();
        
        if(empty($user)){
            return response()->json("User not found"); 
        }
        return response()->json($user);
    }

    ///Count Users
    public function countUser()
    {
        $count = User::all()->count();
        return $count;
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
        //dd($data);

        $this->validate($request,[
            "name" => 'required',
            "email" => 'required',
            "password" => 'required',
            "birth" => 'required',
            "phone" => 'required',
            "identity" => 'required',
            "role" => 'required',
        ]);

        return User::create([
            "name" => $request['name'],
            "identity" => $request['identity'],
            "email" => $request['email'],
            "password" => Hash::make($request['password']),
            "birth" => $request['birth'],
            "phone" => $request['phone'],
            "address" => $request['address'],
            "city" => $request['city'],
            "country" => $request['country'],
            'role' => $request['role'],
            //$confirmed = $confirmed,
        ]);
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
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:25',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6',
            'role' => 'required',
        ]);
        $user->update($request->all());
        return $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $user = User::findOrFail($id);

        //delete user 
        $user->delete();
        return ['massage' => 'deleted user'];
    }

    public function getAuthorize($id)
    {
        $user = User::where('id', $id)->first();
        if($user->authorization == 'unauthorized')
        {
            $user->authorization = 'authorized';  

        }else{
            $user->authorization = 'unauthorized';
        }
        
        $user->update();
    }
}
