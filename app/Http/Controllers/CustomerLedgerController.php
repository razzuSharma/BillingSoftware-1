<?php

namespace App\Http\Controllers;

use App\Models\CustomerLedger;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customerledger.index', [
            'customers' => $customers,
            'customerLedger' => null
        ]);
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
     * @param  \App\Models\CustomerLedger  $customerLedger
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $customers = Customer::all();
        $customerName = Customer::find($request->customer_id);
        $customerLedger = CustomerLedger::where('customer_id', $request->customer_id)->get();
        return view('customerledger.index', [
            'customers' => $customers,
            'customerName' => $customerName,
            'customerLedger' => $customerLedger
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerLedger  $customerLedger
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerLedger $customerLedger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerLedger  $customerLedger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerLedger $customerLedger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerLedger  $customerLedger
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerLedger $customerLedger)
    {
        //
    }
}
