<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScheduleService;

class ScheduleServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ScheduleService::latest()->get();
    }
    ///Count ScheduleService
    public function countScheduleService()
    {
        $count = ScheduleService::all()->count();
        return $count;
    }
    public function viewSchedulePayment($id)
    {
        $schedul = ScheduleService::where(['id' => $id])->first();
        return $schedul;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $delete = ScheduleService::findOrFail($id);
        $delete->delete();
    }


    public function approveSchedule($id)
    {   $status = 'pending';
        //$schedul = ScheduleService::where('id', $id)->first();
        $result =  ScheduleService::where('id', $id)->update(['status' => $status]);
        //dd($result);
        return response()->json($result, 200)
        ->header('Content-Type', 'text/plain');
        //response()->json($skill); 
    }
    public function desapproveSchedule($id)
    {   $status = 'Not approved';
        //$schedul = ScheduleService::where('id', $id)->first();
        $result =  ScheduleService::where('id', $id)->update(['status' => $status]);
        //dd($result);
        return response()->json($result, 200)
        ->header('Content-Type', 'text/plain');
        //response()->json($skill); 
    }
}
