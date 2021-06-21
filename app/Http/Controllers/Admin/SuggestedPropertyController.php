<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suggest;

class SuggestedPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Suggest::latest()->get();
    }
    ///Count Suggestes
    public function countSuggest()
    {
        $count = Suggest::all()->count();
        return $count;
    }
    public function countSuggestUnread()
    {
        $status = "unread";
        $count = Suggest::where(['status' => $status])->count();
        return $count;
    }
    public function GetSuggest($id)
    {
        $suggest = Suggest::where(['id' => $id])->first();
        return $suggest;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        //dd($id);
        //$suggest = Suggest::findOrFail($id);
        $suggest = Suggest::where(['id' => $id])->first();
        $this->validate($request, [
            'yourname' => 'required',
            'youraddress' => 'required',
            'yourphone' => 'required',
            'ownername' => 'required',
            'owneraddress' => 'required',
            'ownerphone' => 'required',
            'status' => 'required',
        ]);
        $upadeted = $suggest->update($request->all());
        return $upadeted;
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
