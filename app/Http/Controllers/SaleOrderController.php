<?php

namespace App\Http\Controllers;

use App\Models\SaleOrder;
use App\Models\Sale;
use App\Models\ProductDetail;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
//34,930

class SaleOrderController extends Controller
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
    public function create($id) //Sales id
    {
        $stock = ProductDetail::all();
        $sales = Sale::find($id);
        $salesOrder = SaleOrder::where('sale_id', $id)->get();

        $totalAmount = SaleOrder::where('sale_id', $id)->sum('amount');
        $discountAmount = SaleOrder::where('sale_id', $id)->sum('discount_amount');
        return view('saleorder.create', [
            'stock' => $stock,
            'sales' => $sales,
            'salesOrder' => $salesOrder,
            'totalAmount' => $totalAmount,
            'discountAmount' => $discountAmount,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Stores sale order and deduct stock quantity from product detail table
    public function store(Request $request, $id)
    {
        $stock = ProductDetail::find($request->product_detail_id);
        $stock->quantity = $stock->quantity - $request->quantity;
        $stock->save();

        $purchaseItem = PurchaseItem::find($stock->purchase_item_id);

        $saleOrder = new SaleOrder;
        $saleOrder->sale_id = $id;
        $saleOrder->product_detail_id = $request->product_detail_id;
        $saleOrder->quantity = $request->quantity;
        $saleOrder->rate = $request->rate;
        $saleOrder->amount = $request->quantity * $request->rate;
        $saleOrder->discount_percent = $request->discount_percent;
        $saleOrder->discount_amount = $request->discount_percent / 100 * $saleOrder->amount;
        $saleOrder->profit_per_item = $request->rate - $purchaseItem->rate;
        $saleOrder->total_profit = ($saleOrder->profit_per_item * $request->quantity) - $saleOrder->discount_amount;
        $saleOrder->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    // Deletes sales order row and makes the quantity same as before in product details table.
    public function destroy($id) // Sales order id
    {
        $salesOrder = SaleOrder::findorfail($id);
        $productDetail = ProductDetail::find($salesOrder->product_detail_id);
        $productDetail->quantity  = $productDetail->quantity + $salesOrder->quantity;
        $productDetail->save();
        $salesOrder->delete(); 
        return back();
    }
}
