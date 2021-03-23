<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use App\Models\Obligation;
use Illuminate\Http\Request;

class ObligationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $customers = Customer::get();

        if (request()->has('customer','statusPayment')) {
         //   dd($request->statusPayment);

            if ($request->customer == '0') {
                $obligations= Obligation::where('status',$request->statusPayment)->with('customer', 'payments');
            }
            else {

                $obligations = Obligation::where('customer_id',$request->input('customer'))
                    ->where('status',$request->input('statusPayment'))
                    ->with('customer','payments');
            }
        }
        elseif ($request->has('customer')){
            $obligations = Obligation::where('customer_id',$request->input('customer'))

                    ->with('customer','payments');
        }
        else {
            $obligations= Obligation::where('status',1)->with('customer');
        }
            $obligations = $obligations->orderBy('id', 'desc')->get();

        return view('pages.obligations/index', compact('obligations'), compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::where('is_active', '1')->get();
        return view('pages.obligations/create', compact('customers'));

    }
    public function autoCreate()
    {
        $startDate = Carbon::now();
        $firstDay = $startDate->firstOfMonth();


        $customers = Customer::wheredoesntHave('obligations', function($q) use ($firstDay){
            $q->where('payment_peroid', $firstDay);
        })->where('is_active', '1')->where('reminder', '1')->get();
            foreach ($customers as $customer)
            {
                $obligation = new Obligation;
                $obligation->customer_id=$customer->id;
                $obligation->payment_peroid=$firstDay;
                $obligation->total_amount=$customer->default_amount;
                $obligation->title=$customer->title;
                $obligation->status='1';
                $obligation->save();
            }

            //$customers = Customer::where('is_active', '1')->where('reminder', '1')->pluck('id');
    //    return $customers;

        // foreach ($customers as $item)
        //  {
        //   $c[$item] = Customer::find($item);
        //    $t[$item]= $c[$item]->obligations()->where('payment_peroid', $firstDay)->first();
        //    if ($t[$item] == null) {

        //        $obligation = new Obligation;
        //        $obligation->customer_id=$c[$item]['id'];
        //        $obligation->payment_peroid=$firstDay;
        //        $obligation->total_amount=$c[$item]['default_amount'];
        //        $obligation->title=$c[$item]['title'];
        //        $obligation->status='1';
        //        $obligation->save();
        //    }
        //    else {
        //       echo $t[$item]. 'ok <br>';
        //    }

        //  }
        return redirect()->route('obligations-index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'customer' => 'required',
            'title' => 'required',
            'paymentPeroid' => 'required',
            'total_amount' => 'required'
        ]);

        $obligation= new Obligation;
        $obligation->customer_id=$request->input('customer');
        $obligation->title= $request->input('title');
        $obligation->payment_peroid= $request->input('paymentPeroid');
        $obligation->total_amount=$request->input('total_amount');
        $obligation->status= '1';
        $obligation->save();
        return redirect()->route('obligations-index')->with('status', 'Płatność dodana prawidłowo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Obligation  $obligation
     * @return \Illuminate\Http\Response
     */
    public function show(Obligation $obligation, $id)
    {
        $obligation = Obligation::find($id);
            $customer = $obligation->customer;
            $payments = $obligation->payments;


        return view('pages.obligations.show')
            ->with('obligation', $obligation)
            ->with('customer', $customer)
            ->with('payments', $payments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Obligation  $obligation
     * @return \Illuminate\Http\Response
     */
    public function edit(Obligation $obligation, $id)
    {
        $obligation = Obligation::find($id);

            return view('pages.obligations.edit', compact('obligation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Obligation  $obligation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obligation $obligation, $id)
    {

        $obligation = Obligation::find($id);
        $obligation->title= $request->input('title');
        $obligation->payment_peroid = $request->input('paymentPeroid');
        $obligation->total_amount = $request->input('total_amount');
        $obligation->save();
        return redirect()->route('obligations-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Obligation  $obligation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Obligation $obligation)
    {
        //
    }
}
