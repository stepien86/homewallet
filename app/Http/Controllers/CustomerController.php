<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Obligation;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers= Customer::paginate(5);
        return view('pages.customers/index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.customers.create');
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
            'name' => 'required',
            'title' => 'required',
            'account' => 'required',
            'defaultAmount' => 'required'
        ]);
        $newCustomer = new Customer;
            $newCustomer->name= $request->input('name');
            $newCustomer->title= $request->input('title');
            $newCustomer->account=$request->input('account');
            $newCustomer->default_amount = $request->input('defaultAmount');
            if($request->has('isActive')){
                $newCustomer->is_active = '1';
            }else{
                $newCustomer->is_active = '0';
            }
            if($request->has('reminder')){
                $newCustomer->reminder = '1';
            }else{
                $newCustomer->reminder = '0';
            }
            $newCustomer->save();
                return redirect()->route('customers')->with('status', 'Dodano poprawnie!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer, $id)
    {
        $customer= Customer::find($id);

        return view('pages.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer, $id)
    {
        $customer = Customer::find($id);
        $customer->name= $request->input('name');
        $customer->title = $request->input('title');
        $customer->account= $request->input('account');
        if($request->has('isActive')){
            $customer->is_active = '1';
        }else{
            $customer->is_active = '0';
        }
        if($request->has('reminder')){
            $customer->reminder = '1';
        }else{
            $customer->reminder = '0';
        }
        $customer->save();
            return redirect()->route('customers');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
    public function customerPayments(Request $request, $id){

      // $obligations = Customer::find($id)->obligations()->with('payments')->get();
       $obligations = Obligation::where('customer_id', $id)->with('payments')->get();


      if ($request->has('date-from') and $request->filled('date-to') == null ) {
            $dataFrom= $request->input('date-from');
            $set = Carbon::now();
            $now = $set->toDateString();
            $obligations = Obligation::where('customer_id', $id)
          ->with(['payments' => function ($query) use ($dataFrom, $now){
              $query->whereBetween('date', [$dataFrom,$now]);
          }])->get();
        }

        elseif ($request->has('date-to') and $request->filled('date-null') == null ) {

            $dataFrom= '1900-01-01';
            $dataTo= $request->input('date-to');

            $obligations = Obligation::where('customer_id', $id)
          ->with(['payments' => function ($query) use ($dataFrom,  $dataTo){
              $query->whereBetween('date', [$dataFrom,$dataTo]);
          }])->get();
        }
        elseif($request->filled('date-from', 'date-to')){

            $dataFrom= $request->input('date-from');
            $dataTo= $request->input('date-to');

            $obligations = Obligation::where('customer_id', $id)
            ->with(['payments' => function ($query) use ($dataFrom, $dataTo){
                $query->whereBetween('date', [$dataFrom,$dataTo]);
            }])->get();
        }

       return view('pages.customers.payments-customer')
                       ->with('obligationsPayments', $obligations)
                       ->with('id', $id);



    }
}
