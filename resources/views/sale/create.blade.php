@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <form action="/sales/save" method="POST" class="row">
            @csrf
            <div class="col-md-3">
                <label for="">Date</label>
                <input type="date" name="date" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="">Invoice No.</label>
                <input type="text" name="invoice_no" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="">Customer</label>
                <select name="customer_id" id="" class="form-control" required>
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Sales Type</label>
                <select name="sales_type" id="" class="form-control" required>
                    <option value="Cash">Cash</option>
                    <option value="Credit">Credit</option>
                </select>
            </div>
            <div class="col-md-12 mt-2">
                <center><input type="submit" value="NEXT" class="btn btn-md btn-primary"></center>
            </div>
        </form>
    </div>
@endsection