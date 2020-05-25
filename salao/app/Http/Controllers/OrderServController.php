<?php

namespace App\Http\Controllers;

use App\OrderServ;
use Illuminate\Http\Request;

class OrderServController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sistema.ordemServ');
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
     * @param  \App\OrderServ  $orderServ
     * @return \Illuminate\Http\Response
     */
    public function show(OrderServ $orderServ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderServ  $orderServ
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderServ $orderServ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderServ  $orderServ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderServ $orderServ)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderServ  $orderServ
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderServ $orderServ)
    {
        //
    }
}
