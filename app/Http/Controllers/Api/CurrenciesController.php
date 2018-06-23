<?php

namespace App\Http\Controllers\Api;

use App\Currency;
use App\Http\Requests\CreateCurrencyRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::orderBy('id', 'DESC')->paginate(50);

        return response([
            'currencies' => $currencies,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCurrencyRequest $request)
    {
        $currency = Currency::create(request()->all());

        return response([
            'currency' => $currency,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        return response([
            'currency' => $currency,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCurrencyRequest $request, $id)
    {
        $currency = Currency::find($id);
        $currency->update(request()->all());

        return response([
            'currency' => $currency,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Currency  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return response([
            'message' => 'deleted',
        ], 200);
    }



}
