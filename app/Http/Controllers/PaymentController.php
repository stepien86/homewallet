<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Obligation;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PaymentCategory;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {
        $payments = Payment::orderBy('id','desc')->with('category','type');

        if($request->filled('date-from'))
        {
            $dataFrom= $request->input('date-from');
            $set = Carbon::now();
            $now = $set->toDateString();
           // dd($now);
            $payments->whereBetween('date',[$dataFrom, $now]);
        }

        if($request->filled('date-to'))
        {
            $dataFrom= $request->input('date-from');
            $dataTo= $request->input('date-to');
            $payments->whereBetween('date',[$dataFrom, $dataTo]);
        }


      $pay = $payments->get();
            return view('pages.payments/index')->with('payments',$pay);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obligations=Obligation::where('status', '1')->get();
        $paymentType= PaymentType::where('is_active', '1')->get();
        $paymentCategory = PaymentCategory::where('is_active', '1')->get();
      //  dd($paymentType);

        return view('pages.payments/create')->with('obligations',$obligations)
                                            ->with('paymentType',$paymentType)
                                            ->with('paymentCategory', $paymentCategory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $payment = New Payment;
            $payment->amount=$request->input('amount');
            $payment->date=$request->input('payment-date');
            $payment->category_id=$request->input('payment-category');
            $payment->type_id=$request->input('payment-type');
            $payment->save();

        $obligationId=$request->input('obligation-id');
        if($obligationId > 0) {
            $payment->obligations()->sync([$obligationId]);
            $obligation= Obligation::find($obligationId);
                //*** Jeżeli kwota wpłaty jest taka sama jak zobowiązaniw zaktualizuj status */
                if ($obligation->total_amount == $request->input('amount')) {
                    $obligation->status='2';
                    $obligation->save();
                }
                else {
                    $paymentSum = 0;
                    foreach ($obligation->payments as $payment){
                        $paymentSum += $payment->amount;
                    }
                    //*** Jeżeli kwota wpłaty jest równa pozostałym wpłatom oznacz płatnosc jako zapłaconą */
                    if ($obligation->total_amount == $paymentSum) {
                        $obligation->status='2';
                        $obligation->save();
                    }
                    //*** jeżeli nie nie zmieniaj statusu */
                    else {
                        $obligation->status='1';
                        $obligation->save();
                    }
                }
        }
        return redirect('payments')->with('status', 'Zarejestrowano płatność!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment, $id)
    {
        $payment= Payment::findOrfail($id);
            foreach ($payment->obligations as $obligation)
            {
                $obligation->id;
            }
       $obligation = Obligation::find($obligation->id);
       $obligation->status='1';
       $obligation->save();

     $payment->delete();
     return redirect('payments')->with('status', 'Przelew usunięto!');
    }

    public function PayO(Request $request)
    {
        $idObligation = $request->input('obligation');

        $paymentType= PaymentType::where('is_active', '1')->get();
        $paymentCategory = PaymentCategory::where('is_active', '1')->get();

         return view('pages.payments.payObligation')
                 ->with('amount', $request->input('amount'))
                 ->with('idObligation', $request->input('obligation'))
                 ->with('paymentType',$paymentType)
                 ->with('paymentCategory', $paymentCategory);
    }
}
