<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CustomerAuthController extends Controller
{
    //customer login page
    function customer_login_page()
    {
        return view('frontend.customer.customer_login_page');
    }

    //customer register page
    function customer_registar_page()
    {
        return view('frontend.customer.customer_register_page');
    }

    //customer register post
    function customer_register_post(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:customers|email',
            'password'=>['required',Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(),'confirmed'],
            'password_confirmation'=>'required',
        ]);

        Customer::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'Created_at'=>Carbon::now(),
        ]);

        if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('welcome');
        }
    }

    //customer_login_post
    function customer_login_post(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if(Customer::where('email',$request->email)->exists()){
            if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('welcome')->with('login','login');
            }
            else {
                return back()->with('password','this password dose not match with this email');
            }
        }
        else{
            return back()->with('email','this email dose not exists');
        }
    }

    //customer logout
    function customer_logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('welcome');
    }

    //customer profile
    function customer_profile()
    {
        return view('frontend.customer.customer_profile');
    }

}
