<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index'])->name('company.index');
Route::get('/company/add', [App\Http\Controllers\CompanyController::class, 'create'])->name('company.add')->middleware('auth');
Route::post('/company/save', [App\Http\Controllers\CompanyController::class, 'store'])->name('company.store')->middleware('auth');
Route::get('/company/edit/{id}', [App\Http\Controllers\CompanyController::class, 'edit'])->name('company.edit')->middleware('auth');
Route::post('/company/update/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('company.update')->middleware('auth');
Route::post('/company/delete/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('company.delete')->middleware('auth');

Route::get('/supplier', [App\Http\Controllers\SupplierController::class, 'index'])->name('supplier.index');
Route::get('/supplier/add', [App\Http\Controllers\SupplierController::class, 'create'])->name('supplier.add');
Route::post('/supplier/save', [App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.store');
Route::get('/supplier/edit/{id}', [App\Http\Controllers\SupplierController::class, 'edit'])->name('supplier.edit');
Route::post('/supplier/update/{id}', [App\Http\Controllers\SupplierController::class, 'update'])->name('supplier.update');

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::get('/product/add', [App\Http\Controllers\ProductController::class, 'create'])->name('product.add');
Route::post('/product/save', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');

Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/add', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.add');
Route::post('/customer/save', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/edit/{id}', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
Route::post('/customer/update/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');

Route::get('/purchase', [App\Http\Controllers\PurchaseController::class, 'index'])->name('purchase.index');
Route::get('/purchase/add', [App\Http\Controllers\PurchaseController::class, 'create'])->name('purchase.add');
Route::post('/purchase/save', [App\Http\Controllers\PurchaseController::class, 'store'])->name('purchase.store');
Route::get('/purchase/edit/{id}', [App\Http\Controllers\PurchaseController::class, 'edit'])->name('purchase.edit');
Route::post('/purchase/update/{id}', [App\Http\Controllers\PurchaseController::class, 'update'])->name('purchase.update');
Route::post('/purchase/complete/{id}', [App\Http\Controllers\PurchaseController::class, 'completePurchase'])->name('purchase.complete');
Route::get('/purchase/bill/{id}', [App\Http\Controllers\PurchaseController::class, 'showBill'])->name('purchase.bill');
Route::get('/purchase/return/{id}', [App\Http\Controllers\PurchaseController::class, 'purchaseReturn'])->name('purchase.return');

Route::get('/purchase/purchaseitem/{id}', [App\Http\Controllers\PurchaseItemController::class, 'create'])->name('purchaseitem.add');
Route::post('/purchaseitem/save/{id}', [App\Http\Controllers\PurchaseItemController::class, 'store'])->name('purchaseitem.save');
Route::get('/purchaseitem/delete/{id}', [App\Http\Controllers\PurchaseItemController::class, 'destroy'])->name('purchaseitem.delete');
Route::post('/purchaseitem/return/{id}', [App\Http\Controllers\PurchaseItemController::class, 'returnPurchaseItem'])->name('purchaseitem.return');

Route::get('/stock', [App\Http\Controllers\ProductDetailController::class, 'index'])->name('stock.index');

Route::get('/Supplier/index', [App\Http\Controllers\SupplierLedgerController::class, 'index'])->name('supplierledger.index');
Route::post('/Supplier/ledger', [App\Http\Controllers\SupplierLedgerController::class, 'show'])->name('supplierledger.show');
// Route::get('/Supplier/payment', [App\Http\Controllers\SupplierLedgerController::class, 'payment'])->name('supplier.pay');

Route::get('/sales/index', [App\Http\Controllers\SaleController::class, 'index'])->name('sales.index');
Route::get('/sales/add', [App\Http\Controllers\SaleController::class, 'create'])->name('sales.add');
Route::post('/sales/save', [App\Http\Controllers\SaleController::class, 'store'])->name('sales.store');
Route::get('/sales/edit/{id}', [App\Http\Controllers\SaleController::class, 'edit'])->name('sales.edit');
Route::post('/sales/update/{id}', [App\Http\Controllers\SaleController::class, 'update'])->name('sales.update');
Route::post('/sales/complete/{id}', [App\Http\Controllers\SaleController::class, 'completeSales'])->name('sales.complete');
Route::get('/sales/bill/{id}', [App\Http\Controllers\SaleController::class, 'showBill'])->name('sales.bill');

Route::get('/salesorder/create/{id}', [App\Http\Controllers\SaleOrderController::class, 'create'])->name('salesorder.create');
Route::post('/salesorder/save/{id}', [App\Http\Controllers\SaleOrderController::class, 'store'])->name('salesorder.save');
Route::get('/salesorder/delete/{id}', [App\Http\Controllers\SaleOrderController::class, 'destroy'])->name('salesorder.delete');

Route::get('/Customer/ledger/index', [App\Http\Controllers\CustomerLedgerController::class, 'index'])->name('customerledger.index');
Route::post('/Customer/ledger', [App\Http\Controllers\CustomerLedgerController::class, 'show'])->name('customerledger.ledger');