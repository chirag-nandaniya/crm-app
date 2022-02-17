<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'customers.index',
            [
                'customers' => Customer::all(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'phone_number' => 'required|string|min:10',
            'email' => 'required|string|email|max:255',
            'budget' => 'required|digits:2',
            'massage' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect('customers/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        

        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->phone_number = $request->input('phone_number');
        $customer->email = $request->input('email');
        $customer->budget = $request->input('budget');
        $customer->message = $request->input('message');

        $customer->save();

        $request->session()->flash('status', 'Customer was Created!');

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view(
            'customers.show',
            [
                'customer' => Customer::findOrFail($id),
            ]
        );
    }
}