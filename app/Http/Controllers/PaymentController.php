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
        $payments = Payment::orderBy('id','desc')->with('category','type','obligation');
        $pay = $payments->paginate(3);

        if($request->filled('date-from'))
        {
            $dataFrom= $request->input('date-from');
            $set = Carbon::now();
            $now = $set->toDateString();
           // dd($now);
            $payments->whereBetween('date',[$dataFrom, $now]);
            $pay = $payments->paginate(0);
        }

        if($request->filled('date-to'))
        {
            $dataFrom= $request->input('date-from');
            $dataTo= $request->input('date-to');
            $payments->whereBetween('date',[$dataFrom, $dataTo]);
            $pay = $payments->paginate(0);
        }
   //  $pay = $payments->get();
   //   dd($pay);
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
        $request->validate([
            'amount' => 'required',
            'payment-date' => 'required',
            'title' => 'required'

        ]);
        $payment = New Payment;
            $payment->amount=str_replace(',', '.',$request->input('amount'));
            $payment->title = $request->input('title');
            $payment->date=$request->input('payment-date');
            $payment->category_id=$request->input('payment-category');
            $payment->type_id=$request->input('payment-type');
           // $payment->save();

        $obligationId=$request->input('obligation-id');
        if($obligationId > 0) {

            $payment->obligation_id= $obligationId;
            $payment->save();
              $obligation= Obligation::find($obligationId);
                //*** Je??eli kwota wp??aty jest taka sama jak zobowi??zaniw zaktualizuj status */
                if ($obligation->total_amount <= str_replace(',', '.',$request->input('amount'))) {
                    $obligation->status='2';
                    $obligation->save();
                }
                else {
                    $paymentSum = 0;
                    foreach ($obligation->payments as $payment){
                        $paymentSum += $payment->amount;
                    }
                    //*** Je??eli kwota wp??aty jest r??wna pozosta??ym wp??atom oznacz p??atnosc jako zap??acon?? */
                    if ($obligation->total_amount == $paymentSum) {
                        $obligation->status='2';
                        $obligation->save();
                    }
                    //*** je??eli nie nie zmieniaj statusu */
                    else {
                        $obligation->status='1';
                        $obligation->save();
                    }
                }
        }
        else {
            $payment->obligation_id = '0';
            $payment->save();
        }
        return redirect('payments')->with('status', 'Zarejestrowano p??atno????!');

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
            $obid =  $payment->obligation_id;
            if($obid > 0) {

                $obligation = Obligation::find($obid);
                $obligation->status='1';
                $obligation->save();
                $payment->delete();
            }
            $payment->delete();

     return redirect('payments')->with('status', 'Przelew usuni??to!');
    }


    public function PayO(Request $request)
    {
        $idObligation = $request->input('obligation');

        $paymentType= PaymentType::where('is_active', '1')->get();
        $paymentCategory = PaymentCategory::where('is_active', '1')->get();

         return view('pages.payments.payObligation')
                 ->with('amount', $request->input('amount'))
                 ->with('title', $request->input('title'))
                 ->with('idObligation', $request->input('obligation'))
                 ->with('paymentType',$paymentType)
                 ->with('paymentCategory', $paymentCategory);
    }
}
