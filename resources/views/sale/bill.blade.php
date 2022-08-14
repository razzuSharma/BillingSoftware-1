@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-11">
            <a href="{{ route('sales.index') }}" class="btn btn-outline-primary"><span>&#8592;</span></a>
        </div>
        <div class="col-md-1">
            <button class="btn btn-sm btn-outline-primary active" onclick="window.print()">Print</button>
        </div>  
    </div>

    <div class="card card-body shadow-sm mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center">Blue Fox Pvt. Ltd.</h4>
            </div>
            <div class="row mt-4">
                <div class="col-md-5">
                    <p>Customer Name: {{ $sales->customer->name }}</p>
                    <p>Customer Address: {{ $sales->customer->address }}</p>
                </div>
                <div class="col-md-4">
                    <h6>{{ $sales->sales_type }} #{{ $sales->id }}</h6> 
                </div>
                <div class="col-md-3">
                    <p>Date: {{ $sales->date }}</p>
                    <p>Invoice: {{ $sales->invoice_no }}</p>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="fw-bold">
                                <tr>
                                    <th>S.N.</th>
                                    <th>Product</th>
                                    <th>Unit</th>
                                    <th>Qty.</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                    <th>Discount%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($salesOrder as $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->productDetail->product->name }}</td>
                                    <td>{{ $row->productDetail->product->unit }}</td>
                                    <td>{{ $row->quantity }}</td>
                                    <td>{{ $row->rate }}</td>
                                    <td>{{ $row->amount }}</td>
                                    <td>{{ $row->discount_percent }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <div class="row">
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Total Amount</td>
                                            <td>{{ $totalAmount }}</td>
                                        </tr>
                                    </div>
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Discount Amount</td>
                                            <td>{{ $discountAmount }}</td>
                                        </tr>
                                    </div>
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Rounding Amount</td>
                                            <td>{{ number_format(($totalAmount - $discountAmount) - round($totalAmount - $discountAmount), 2) }}</td>
                                        </tr>
                                    </div>
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Shipping Cost</td>
                                            <td>{{ $sales->shipping_cost }}</td>
                                        </tr>
                                    </div>
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Adjustable Discount</td>
                                            <td>{{ $sales->adjustable_discount }}</td>
                                        </tr>
                                    </div>
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Net Amount</td>
                                            <td>{{ (($totalAmount - $discountAmount) + $sales->shipping_cost) - (($sales->adjustable_discount/100) * ($totalAmount - $discountAmount)) }}</td>
                                        </tr>
                                    </div>
                                </div>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6" style="text-align:left">
                        <p>Checked By: </p>
                    </div>
                    <div class="col-md-6" style="text-align:right">
                        <p>User: {{ Auth::user()->name }}</p>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection