<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_CUSTOMER');
    }

    public function index()
    {
        
        return view('customer.home');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(User $customer)
    {
        return view('customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $customer)
    {
        $request->validate([
            'name'=> 'required', 
            'email'=> 'required',
            'password'=> 'required',
            'password_confirmation' => 'required',
            'age'=> 'required',
            'date_of_birth'=> 'required',
        ]);

        $user = new User();



        $confirm = $request->get('password_confirmation');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->age = $request->get('age');
        $user->date_of_birth = $request->get('date_of_birth');
        $user->password = $request->get('password');
        
   if($user->password == $confirm)
   {
        $film->save();
   }

   else{
    return redirect()->route('customer.index')->with('error','Customer not updated,Password mismatched');
   }
        return redirect()->route('customer.index')->with('success','Customer updated successfully');
    }

}
