<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white active" aria-current="page" href="{{ route('home.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Project</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">About</a>
                </li>
                <li class="nav-list">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-danger text-white" role="submit">Log out</button>
                    </form>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success text-white" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-4">
            <div class="col-md-3 fixed-top one m-5">
                <div class="list-group mt-5">
                    <a href="{{ route('home.index') }}" class="list-group-item d-flex justify-content-between align-items-center {{ (request()->is('home')) ? 'active' : '' }}">Home
                        <span class="badge badge-pill ml-5 {{ (request()->is('home')) ? 'bg-danger' : 'bg-primary' }}">0</span>
                    </a>
                    <a href="{{ route('company.index') }}" class="list-group-item d-flex justify-content-between align-items-center {{ (request()->is('company*')) ? 'active' : '' }}">Company
                        <span class="badge badge-pill ml-5 {{ (request()->is('company*')) ? 'bg-danger' : 'bg-primary' }}">0</span>
                    </a>
                    <a href="{{ route('supplier.index') }}" class="list-group-item d-flex justify-content-between align-items-center {{ (request()->is('supplier*')) ? 'active' : '' }}">Supplier
                        <span class="badge badge-pill ml-5 {{ (request()->is('supplier*')) ? 'bg-danger' : 'bg-primary' }}">0</span>
                    </a>
                    <a href="{{ route('product.index') }}" class="list-group-item d-flex justify-content-between align-items-center {{ (request()->is('product*')) ? 'active' : '' }}">Product
                        <span class="badge badge-pill ml-5 {{ (request()->is('product*')) ? 'bg-danger' : 'bg-primary' }}">0</span>
                    </a>
                    <a href="{{ route('customer.index') }}" class="list-group-item d-flex justify-content-between align-items-center {{ (request()->is('customer*')) ? 'active' : '' }}">Customer
                        <span class="badge badge-pill ml-5 {{ (request()->is('customer*')) ? 'bg-danger' : 'bg-primary' }}">0</span>
                    </a>
                    <a href="{{ route('purchase.index') }}" class="list-group-item d-flex justify-content-between align-items-center {{ (request()->is('purchase*')) ? 'active' : '' }}">Purchase
                        <span class="badge badge-pill ml-5 {{ (request()->is('purchase*')) ? 'bg-danger' : 'bg-primary' }}">0</span>
                    </a>
                    <a href="{{ route('stock.index') }}" class="list-group-item d-flex justify-content-between align-items-center {{ (request()->is('stock*')) ? 'active' : '' }}">Stock
                        <span class="badge badge-pill ml-5 {{ (request()->is('stock*')) ? 'bg-danger' : 'bg-primary' }}">0</span>
                    </a>
                    <a href="{{ route('supplierledger.index') }}" class="list-group-item d-flex justify-content-between align-items-center {{ (request()->is('Supplier*')) ? 'active' : '' }}">Supplier Ledger
                        <span class="badge badge-pill ml-5 {{ (request()->is('Supplier*')) ? 'bg-danger' : 'bg-primary' }}">0</span>
                    </a>
                    <a href="{{ route('customerledger.index') }}" class="list-group-item d-flex justify-content-between align-items-center {{ (request()->is('Customer*')) ? 'active' : '' }}">Customer Ledger
                        <span class="badge badge-pill ml-5 {{ (request()->is('Customer*')) ? 'bg-danger' : 'bg-primary' }}">0</span>
                    </a>
                    <a href="{{ route('sales.index') }}" class="list-group-item d-flex justify-content-between align-items-center {{ (request()->is('sales*')) ? 'active' : '' }}">Sales
                        <span class="badge badge-pill ml-5 {{ (request()->is('sales*')) ? 'bg-danger' : 'bg-primary' }}">0</span>
                    </a>
                </div>
            </div>

            <div class="col-md-9 mt-5 offset-sm-3 one">
                @yield('content')
            </div><!-- .col-md-9 -->
        </div>
    </div><!-- .Container -->

    <footer>
        <div class="container-fluid fixed-bottom bg-dark text-white">
            <div class="row">
                <div class="col-md-11">Copyright &copy</div>
                <div class="col-md-1">2021</div>
            </div>
        </div>
    </footer>
</body>

</html>