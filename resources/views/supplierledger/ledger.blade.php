@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-5">

            @if ($supplierLedger->count() != 0)
                <h3 class="text-primary text-center">Supplier Ledger of {{ $supplier->name }}</h3><hr size="3">
                <div class="table-responsive">
                    <table class="table table-bordered mt-2 bg-light">
                        <thead class="fw-bold text-center">
                            <th>S.N.</th>
                            <th>Date</th>
                            <th>Invoice Number</th>
                            <th>Purchase Type</th>
                            <th>Dr.</th>
                            <th>Cr.</th>
                            <th>Balance</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($supplierLedger as $value)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $value->date }}</td>
                                    <td>{{ $value->invoice_no }}</td>
                                    <td>{{ $value->purchase_type }}</td>
                                    <td>{{ $value->dr }}</td>
                                    <td>{{ $value->cr }}</td>
                                    <td>{{ $value->balance }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
            @else
                <h1 class="text-center text-danger mt-5">Ledger doesn't exist of {{ $supplier->name }} Supplier</h1>
                <h5 class="text-center text-danger">No Purchase Yet</h5>
            @endif
        </div>
    </div>
@endsection