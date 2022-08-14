@extends('layouts.app')
@section('content')
    <div çlass='container'> 
        <div class="card card-body mt-5">

            <form method="POST" action="{{ route('salesorder.save', ['id' => $sales->id]) }}" class="row">
                @csrf
                <div class="col-md-4">
                    <select name="product_detail_id" class="form-control" required>
                        <option value="">Select Product</option>
                        @foreach ($stock as $row)
                        @if ($row->quantity != 0)
                            <option value="{{ $row->id }}">{{ $row->product->name }} / {{ $row->quantity }} / SP: {{ $row->sp }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="quantity" placeholder="Quantity" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="number" name="rate" placeholder="Rate" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="number" name="discount_percent" placeholder="Discount%" class="form-control">
                </div>
                <div class="col-md-12 mt-3">
                    <center><input value="DONE" class="btn btn-md btn-primary" type="submit"></center>
                </div>
            </form>
            <br>
        </div>

        <form action="{{ route('sales.complete', ['id'=>$sales->id]) }}" method="POST" class="row mt-3">
            @csrf
                <div class="col-md-4">
                    <label for="">Shipping Cost</label>
                    <input type="number" name="shipping_cost" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="">Adjustable Discount</label>
                    <input type="number" name="adjustable_discount" class="form-control">
                </div>
                <div class="col-md-4 mt-4">
                    <input type="submit" value="DONE" class="btn btn-md btn-primary">
                </div>
        </form>

        <div class="card card-body mt-3 mb-5">
            <h5 class="text-center">{{ $sales->sales_type }} #{{ $sales->id }}</h5>
            <div class="table-responsive">
                <table class="table table-bordered text-center mt-3 bg-light">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Product</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Discount %</th>
                            <th>Action</th>
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
                            <td>
                                <a href="{{ route('salesorder.delete', ['id'=>$row->id]) }}">Delete</a>
                            </td>
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
                                    <td>{{ (($totalAmount - $discountAmount) + $sales->shipping_cost) - ($sales->adjustable_discount/100 * ($totalAmount - $discountAmount)) }}</td>
                                </tr>
                            </div>
                        </div>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@endsection