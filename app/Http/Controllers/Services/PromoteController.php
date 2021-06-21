<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use App\Models\PromoService;

class PromoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth('api')->user();
        return $user->promoservice()->latest()->get();
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
        
        //$promo = PromoService::where('house_code', $data['house_code'])->first();

        $user = Auth('api')->user();
        $receipt = request()->file('receipt_promo');
        $receiptName = $receipt->getClientOriginalName();
        $receiptName = time().'_'.$receiptName;

        $receipt->move(public_path('/images/receipt/promotion'), $receiptName);

        /* if(!$promo){
            return "you already registered this";
        }
        else{
            return "you ";
            
        } */
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
