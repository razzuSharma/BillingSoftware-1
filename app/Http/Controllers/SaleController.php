<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\SaleOrder;
use App\Models\CustomerLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // SHows the main Page, all the sales list
    public function index()
    {
        $sales = Sale::all();
        return view('sale.index', [
            'sales' => $sales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Opens page for inserting sales
    public function create()
    {
        $customers = Customer::all();
        return view('sale.create', [
            'customers' => $customers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Stores the provided sales records.
    public function store(Request $request)
    {
        $sales = new Sale;
        $sales->date = $request->date;
        $sales->invoice_no = $request->invoice_no;
        $sales->customer_id = $request->customer_id;
        $sales->sales_type = $request->sales_type;
        $sales->user_id = Auth::id();
        $sales->save();
        return redirect()->route('salesorder.create', [
            'id' => $sales->id
        ]);
    }

    // Complete the sales status to completed.
    public function completeSales(Request $request, $id) { // Sales id
        $totalAmount = SaleOrder::where('sale_id', $id)->sum('amount');
        $discountAmount = SaleOrder::where('sale_id', $id)->sum('discount_amount');
        $sales = Sale::find($id);
        $sales->shipping_cost = $request->shipping_cost;
        $sales->adjustable_discount = $request->adjustable_discount;
        $sales->total_amount = $totalAmount;
        $sales->discount_amount = $discountAmount;
        $sales->net_amount = (($totalAmount - $discountAmount) + $sales->shipping_cost) - ($sales->adjustable_discount/100 * ($totalAmount - $discountAmount));
        $sales->status = 'Completed';
        $sales->save();
        
        return redirect()->route('sales.bill', ['id'=>$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function showBill($id) // Sale id
    {
        $sales = Sale::find($id);
        $salesOrder = SaleOrder::where('sale_id', $id)->get();
        $totalAmount = SaleOrder::where('sale_id', $id)->sum('amount');
        $discountAmount = SaleOrder::where('sale_id', $id)->sum('discount_amount');

        $getBalance = CustomerLedger::where('customer_id', $sales->customer_id)->get('balance')->last();

        $customerLedger = new CustomerLedger;
        $customerLedger->date = $sales->date;
        $customerLedger->invoice_no = $sales->invoice_no;
        $customerLedger->customer_id = $sales->customer_id;
        $customerLedger->sales_type = $sales->sales_type;
        $customerLedger->user_id = Auth::id();
        if ($customerLedger->sales_type == 'Credit') {
            $customerLedger->cr = (($totalAmount - $discountAmount) + $sales->shipping_cost) - (($sales->adjustable_discount/100) * ($totalAmount - $discountAmount));
            $customerLedger->balance = empty($getBalance) ? $customerLedger->cr : $customerLedger->cr + $getBalance->balance;
        }
        else {
            $customerLedger->dr = (($totalAmount - $discountAmount) + $sales->shipping_cost) - (($sales->adjustable_discount/100) * ($totalAmount - $discountAmount));
            $customerLedger->balance = empty($getBalance) ? '0' : $getBalance->balance - $customerLedger->dr;
        }
        $customerLedger->save();

        return view('sale.bill', [
            'sales' => $sales,
            'salesOrder' => $salesOrder,
            'totalAmount' => $totalAmount,
            'discountAmount' => $discountAmount,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    // Edits the existing sale
    public function edit($id)
    {
        $sale = Sale::find($id);
        $customers = Customer::all();
        return view('sale.edit', [
            'sale' => $sale,
            'customers' => $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    // Updates when edited
    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);
        $sale->date = $request->date;
        $sale->invoice_no = $request->invoice_no;
        $sale->customer_id = $request->customer_id;
        $sale->sales_type = $request->sales_type;
        $sale->user_id = Auth::id();
        $sale->save();
        return redirect()->route('sales.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
