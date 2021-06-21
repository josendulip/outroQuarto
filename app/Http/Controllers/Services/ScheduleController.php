<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScheduleService;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    //for owner
    public function mySchedules()
    {
        //return auth('api')->user()->scheduleservice()->get();
        $status = "Not approved";
        $user = auth('api')->user();
        return ScheduleService::where('owner', $user->id)->where('status','!=', $status)->latest()->paginate(10);

    }
    public function ownerProperty($id)
    {
        $owner = ScheduleService::where('id', $id)->first();
        if($owner)
        return User::where('id', (int)$owner->owner)->first();
    }
    ///for user
    public function mySchedulesUser()
    {
        return auth('api')->user()->scheduleservice()->latest()->paginate(8);
        /* $status = "Not approved";
        $user = auth('api')->user();
        return ScheduleService::where('user_id', $user->id)->where('status','!=', $status)->latest()->paginate(10); */

    }

    public function countSchedules()
    {
        $user = Auth('api')->user();
        //$count = Auth('api')->user()->scheduleservice()->where('status', 'pending')->count();
        $count = ScheduleService::where(['status' => 'pending', 'owner' => $user->id])->count();
        if(empty($count)){
            return 0;
        }

       return $count;
    }
    public function userCountSchedules()
    {
        $user = Auth('api')->user();
        //$count = Auth('api')->user()->scheduleservice()->where('status', 'pending')->count();
        $count = ScheduleService::where(['status' => 'pending', 'user_id' => $user->id])->count();
        if(empty($count)){
            return 0;
        }

       return $count;
    }

    public function getSchedule($id)
    {
        //$user = Auth('api')->user();
        //return Auth('api')->user()->scheduleservice()->where('id', $id)->first();
        return ScheduleService::where('id', $id)->first();
        
       //return $id;
    }
    public function confirmSchedule($id)
    {   $status = 'confirmed';
        //$schedul = ScheduleService::where('id', $id)->first();
        $result = ScheduleService::where('id', $id)->update(['status' => $status]);
        //dd($result);
        return response()->json($result, 200)
        ->header('Content-Type', 'text/plain');
        //response()->json($skill); 
    }
    public function confirmEachFrromAllMsg($id)
    {   $status = 'confirmed';
        //$schedul = ScheduleService::where('id', $id)->first();
        $result =  ScheduleService::where('id', $id)->update(['status' => $status]);
        //dd($result);
        return response()->json($result, 200)
        ->header('Content-Type', 'text/plain');
        //response()->json($skill); 
    }
    public function Reschedule(Request $request, $id)
    {
        //dd($request->all());
        $result = ScheduleService::where('id', $id)->update($request->all());
        //data = $request->all());
        return response()->json($result, 200)
        ->header('Content-Type', 'text/plain');
    }


    public function scheduleVisits(Request $request)
    {
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
            'price' => 'required',
            'date' => 'required',
            'time' => 'required',
            'receipt' => 'required|mimes:jpeg,png,jpg,gif,pdf',
        ]);


        //$user = Auth('api')->user();
        $receipt = request()->file('receipt');
        $receiptName = $receipt->getClientOriginalName();
        $receiptName = time().'_'.$receiptName;

        $receipt->move(public_path('/images/receipt/visit'), $receiptName);

        $user = $request->user();
        tap($user)->update($request->only('phone', 'address'));

        return ScheduleService::create([
            'user_id' => $user->id,
            'username' => $user->name,
            'house_code' => $data['house_code'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'house_city' => $data['house_city'],
            'house_county' => $data['house_county'],
            'house_district' => $data['house_district'],
            'house_street' => $data['house_street'],
            'price' => $data['price'], 
            'date' => $data['date'], 
            'time' => $data['time'],
            'receipt' => 'images/receipt/visit/'.$receiptName,
            'request_type'=> $data['request_type'],
            'owner' => $data['owner']
        ]);

        /* $user->update([
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]); */
        
    }
    public function deleteItem($id)
    {
        $delete = ScheduleService::findOrFail($id);
        $delete->delete();
    }

}
