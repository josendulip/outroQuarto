<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use App\Models\VerifyService;

class VerificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $user = Auth('api')->user();
        return $user->verifyservice()->latest()->get();
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
        //
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
