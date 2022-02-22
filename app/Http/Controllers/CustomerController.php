<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

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
            'budget' => 'required|numeric',
            'message' => 'required|string|min:10'
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

    public function export() 
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }

    public function createwordpressaccount($id){
        
        $customer = Customer::findOrFail($id);
        //dd($customer);
        $name = explode(" ", $customer->name);
        //dd($name);
        
        // $data = [
        //     'user_login' => strtolower($name[0]).strtolower($name[1]),
        //     'email' => $customer->email,
        //     'first_name' => $name[0],
        //     'last_name' => $name[1],
        //     'url' => 'http://crm-app.localhost/customers/'.$customer->id,
        //     'password' => 'Alliswell',
        //     'role' => 'subscriber',
        // ]; 
        // return view(
        //     'customers.createwordpressaccount',
        //     [
        //         'customer' => Customer::findOrFail($id),
        //     ]
        // );
        $response = Http::post('http://wordpress.localhost/wp-admin/admin-ajax.php?action=create_user_for_crm_customer', [
            'user_login' => strtolower($name[0]).strtolower($name[1]),
            'email' => $customer->email,
            'first_name' => $name[0],
            'last_name' => $name[1],
            'url' => 'http://crm-app.localhost/customers/'.$customer->id,
            'password' => 'Alliswell',
            'role' => 'subscriber',
        ]);
        dd($response);
        if($response->successful()){
            session()->flash('message', 'Created Wordpress Account');
            return redirect()->route('customers.index');
        } else {
            session()->flash('error', 'Something went wrong. Try again.');
            return redirect()->route('customers.index');
        }
    }
}