<?php

use App\Models\Payment;
use App\Models\Customer;
use App\Models\Obligation;
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

  //  $obligation = \App\Models\Obligation::find(1);
 //   $obligation->payments()->sync([2]);
   // $payment = \App\Models\Payment::find(1);


  // $payment->obligations;

   // return $payment;
   $customer = Customer::find(1);
 //  return $customer->obligations;
   foreach ($customer->obligations as $p) {
       foreach ($p->payments as $moneta){
          echo $moneta->amount;
       }
   }

    return view('pages.index');
});

Route::get('customers', [CustomerController::class,'index'])->name('customers');
Route::get('customers/create', [CustomerController::class,'create'])->name('customers-create');
Route::post('customers/create/store', [CustomerController::class,'store'])->name('customers-store');
Route::get('customers/edit/{id}', [CustomerController::class,'edit']);
Route::post('customers/update/{id}', [CustomerController::class,'update'])->name('customers-update');
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

Route::get('PayObligations',[PaymentController::class,'PayO'])->name('pay-obligation');
