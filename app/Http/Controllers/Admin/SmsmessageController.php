<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Smsmessage;
use Illuminate\Http\Request;
use Ipecompany\Smsirlaravel\Smsirlaravel;

class SmsmessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Smsmessage.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $SMS_NUMBER=str_replace("-","",$request->input('PhoneNumber'));

        Smsirlaravel::send([$request->input('MessageBody')],[$SMS_NUMBER]);


        dd($SMS_NUMBER ,$request->input('MessageBody'),Smsirlaravel::credit());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Smsmessage  $smsmessage
     * @return \Illuminate\Http\Response
     */
    public function show(Smsmessage $smsmessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Smsmessage  $smsmessage
     * @return \Illuminate\Http\Response
     */
    public function edit(Smsmessage $smsmessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Smsmessage  $smsmessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Smsmessage $smsmessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Smsmessage  $smsmessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Smsmessage $smsmessage)
    {
        //
    }
}
