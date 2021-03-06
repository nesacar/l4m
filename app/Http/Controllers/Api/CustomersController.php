<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::withCount('shoppingCart')->with(['shoppingCart' => function($query){
            $query->withoutGlobalScope('payment')->withoutGlobalScope('customer')->withoutGlobalScope('order')->with('address');
        }])->orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'customers' => $customers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request){
        $customer = Customer::createCustomer();

        return response()->json([
            'customer' => $customer,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return response()->json([
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update(request()->all());

        return response()->json([
            'customer' => $customer,
        ]);
    }

    public function updateCustomer(UpdateCustomerRequest $request, $customer_id, $user_id){
        Customer::updateCustomer($customer_id);

        return response()->json([
            'customer' => Customer::find($customer_id),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json([
            'message' => 'Deleted',
        ]);
    }
}
