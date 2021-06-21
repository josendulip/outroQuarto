<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\appointment;
use App\Models\Property;
use App\Models\User;
use App\Models\Suggest;

class AppointmentController extends Controller

{
    public function getUser()
    {
        $user = Auth('api')->user();
        return $user;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = Auth('api')->user();
        //$data['period'] = 'short period';
        $this->validate($request, [
            'house_code' => 'required',
            'name' => 'required',
            'identity' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required', 
            'date' => 'required', 
            'time' => 'required',
            'payment' => 'required',
            'garden' => 'required',
            'furniture' => 'required',
            'state' => 'required',
        ]);
        $data['period'] = 'short period';
        //dd($data);
        $user->appointment()->create($data);
        return 'scheduled';
    }
    /* public function workWithUs(Request $request)
    {
        $this->validate($request,[
            'yourname' => 'required',
            'youraddress' => 'required',
            'yourphone' => 'required',
            'ownername' => 'required',
            'owneraddress' => 'required',
            'ownerphone' => 'required',
        ]);
        $data = $request->all();
        //dd($request->all());
        $save = Suggest::create([
            'yourname' => $data['yourname'],
            'youraddress' => $data['youraddress'],
            'yourphone' => $data['yourphone'],
            'ownername' => $data['ownername'],
            'owneraddress' => $data['owneraddress'],
            'ownerphone' => $data['ownerphone'],
            ]);
        return response()->json($save, 200);
    } */

}

