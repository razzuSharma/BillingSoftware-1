@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row mt-5">
            <div class="col-md-10">
                <h2>Sales</h2> 
            </div>
            <div class="col-md-2">
                <a href="{{ route('sales.add') }}" class="btn btn-md btn-primary float-left">Add Sales</a>
            </div>
        </div>

        <div class="card card-body mb-5">
            <div class="table-responsive">
                <table class="table table-bordered text-center bg-light">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Invoice Number</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Sales Type</th>
                            <th>Staff</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $sale->invoice_no }}</td>
                                <td>{{ $sale->date }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->sales_type }}</td>
                                <td>{{ Auth::user()->name }}</td>
                                <td>
                                    <a href="{{ route('sales.edit', ['id'=>$sale->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @if ($sale->status == 'Completed')
                                        <a href="{{ route('sales.bill', ['id'=>$sale->id]) }}" class="btn btn-primary btn-sm">Bill</a>
                                    @else
                                    <a href="{{ route('salesorder.create', ['id'=>$sale->id]) }}" class="btn btn-primary btn-sm">Contd.</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection