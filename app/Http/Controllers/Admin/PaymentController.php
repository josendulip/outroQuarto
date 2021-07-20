<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScheduleService;
use App\Models\Property;
use App\Models\User;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function getOwnerPayment()
    {
        $user = auth('api')->user();
        $print = $user->payment()->latest()->paginate(10);
        //dd($print);
        return $print;
    }
    public function getInvoice($id_transation)
    {
       //dd($id_transation);
        return Payment::where('id_transation', $id_transation)->first();
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
        $owner = User::where('id', $request->owner)->first();
        $house = Property::where('house_code', $request->house_code)->first();
        
        $data['outroQuarto_amount'] = ($data['percentage'] / 100) * $data['price'];
        $token = time() . '_' . $owner->id;
        //dd($data); 
        ScheduleService::where('id', $request->id)->update(['percentage' => $data['percentage']]);

        $receipt = request()->file('outroquarto_receipt');
        $receiptName = $receipt->getClientOriginalName();
        $receiptName = time().'_'.$receiptName;

        $receipt->move(public_path('/images/receipt/admin_schedul_verification_payments'), $receiptName);
        $user = auth('api')->user();
        $m_token = $user->identity.'_'.$user->id;
        return Payment::create([
            'user_id' => $owner->id,
            'property_id' => $house->id,
            'id_transation' => $token,
            'username' => $owner->name,
            'identity' => $owner->identity,
            'phone' => $owner->phone,
            'email' => $owner->email,
            'user_address' => $owner->address,
            'user_city' => $owner->city,
            'user_country' => $owner->country,
            'user_photo' => $owner->photo,
            'iban' => $owner->iban,
            'slug' => $owner->slug,
            'house_code' => $house->house_code,
            'house_city' => $house->city,
            'house_county' => $house->county,
            'house_district' => $house->district,
            'house_street' => $house->street, 
            'paid_user_id' => $data['user_id'],
            'paid_user_name' => $data['username'],
            'paid_user_email' => $data['email'],
            'paid_user_phone' => $data['phone'],
            'paid_user_address' => $data['address'],
            'paid_amount' => $data['price'],
            'paid_receipt' => $data['receipt'],
            'paid_date' => $data['created_at'],
            'percentage' => $data['percentage'],
            'outroQuarto_amount' => $data['outroQuarto_amount'],
            'receipt' => 'images/receipt/admin_schedul_verification_payments/'.$receiptName,
            'trans_method' => $data['trans_method'],
            'service' => 'scheduled',
            'description' => $data['description'],
            'status' => $data['status'],
            'manager' => $user->name,
            'manager_id' => $m_token,
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
        dd($request->all());
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
