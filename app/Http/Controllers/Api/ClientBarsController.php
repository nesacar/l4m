<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\ClientBar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientBarsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($client_id)
    {
        $bars = Client::find($client_id)->clientBar;

        return response([
            'bars' => $bars,
        ], 20);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientBar  $clientBar
     * @return \Illuminate\Http\Response
     */
    public function show(ClientBar $clientBar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientBar  $clientBar
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientBar $clientBar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientBar  $clientBar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientBar $clientBar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientBar  $clientBar
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientBar $clientBar)
    {
        //
    }
}
