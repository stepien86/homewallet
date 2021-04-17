<?php

use App\Models\Payment;
use App\Models\Customer;
use App\Models\Obligation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ObligationController;

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

Route::get('/', function () {

    // $nowTimeDate = new Carbon('2016-01-23');
    // $t = $nowTimeDate->addMonth();
    // dd($t);



    return view('pages.index');
});

// Route::get('customers', [CustomerController::class,'index'])->name('customers');
// Route::get('customers/create', [CustomerController::class,'create'])->name('customers-create');
// Route::post('customers', [CustomerController::class,'store'])->name('customers-store');
// Route::get('customers/{customer}/edit', [CustomerController::class,'edit'])->name('customers.edit');
// Route::put('customers/{id}', [CustomerController::class,'update'])->name('customers.update');
Route::resource('customers', CustomerController::class);
Route::get('customers/payments/{id}', [CustomerController::class,'customerPayments'])->name('customers-payments');

Route::get('payments', [PaymentController::class,'index'])->name('payments');
Route::get('new-payment', [PaymentController::class,'create'])->name('new-payment');
Route::post('new-payment', [PaymentController::class,'store'])->name('store-payment');
Route::delete('payments/{id}',[PaymentController::class,'destroy'])->name('destroy-payment');

Route::get('obligations',[ObligationController::class,'index'])->name('obligations-index');
Route::get('obligations/auto-create', [ObligationController::class,'autoCreate'])->name('auto-obligation-create');
Route::get('obligations/create',[ObligationController::class, 'create'])->name('create-obligation');
Route::post('obligations/create/store',[ObligationController::class, 'store'])->name('store-obligation');
Route::get('obligations/edit/{id}', [ObligationController::class, 'edit'])->name('obligations-edit');
Route::post('obligations/update/{id}', [ObligationController::class, 'update'])->name('obligations-update');
Route::get('obligations/show/{id}', [ObligationController::class, 'show'])->name('obligations.show');
Route::delete('obligations/{obligation}', [ObligationController::class, 'destroy'])->name('obligations.destroy');

Route::get('PayObligations',[PaymentController::class,'PayO'])->name('pay-obligation');
