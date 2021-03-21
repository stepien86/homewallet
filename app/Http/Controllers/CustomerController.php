<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
}
