<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    //profile edit page
    function customer_profile_edit()
    {
        $countries = Country::all();
        return view('frontend.customer.customer_profile_edit',[
            'countries'=>$countries,
        ]);
    }

    //country wise city
    function country_wise_city(Request $request)
    {
        $str = '<option value="">Enter City</option>';
        $country_id = $request->country_id;
        $cities = City::where('country_id',$country_id)->get();
        foreach ($cities as $city){
            $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        return $str;
    }

    //customer profile edit

    function customer_profile_change(Request $request)
    {
        $customer_id = Customer::find(Auth::guard('customer')->user()->id);

        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'country_id'=>'required',
            'city_id'=>'required',
            'address'=>'required',
            'zip'=>'required',
            'photo'=>['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
        ]);

        if($request->photo ==''){

            $customer_id->fill($request->all())->save(); // 1 line a update korlam sob 

            return back()->with('update','profile update done');

        }
        else{
            if(Auth::guard('customer')->user()->photo == NULL){

            $img = $request->photo;
            $extention = $img->extension();
            $file_name = uniqid().'.'.$extention;

            Image::make($img)->save(public_path('uploads/customer/'.$file_name));

            $customer_id->fill($request->all());
            $customer_id->photo = $file_name;
            $customer_id->save();

            return back()->with('update','profile update done');

            }
            else {
                $delete_from = public_path('uploads/customer/'.Auth::guard('customer')->user()->photo);
                unlink($delete_from);
                
                $img = $request->photo;
                $extention = $img->extension();
                $file_name = uniqid().'.'.$extention;
    
                Image::make($img)->save(public_path('uploads/customer/'.$file_name));
    
                $customer_id->fill($request->all()); // for photo and save all input
                $customer_id->photo = $file_name;
                $customer_id->save();

                return back()->with('update','profile update done');

            }

        }
    }


    //customer password change

    function customer_password_change()
    {
        return view('frontend.customer.customer_password_change');
    }

    //customer_new_password

    function customer_new_password(Request $request)
    {

        $request->validate([
            'old_password'=>'required',
            'password'=>['required',Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(),'confirmed'],
            'password_confirmation'=>'required',
        ]);

        if(password_verify($request->old_password, Auth::guard('customer')->user()->password)){
            customer::find(Auth::guard('customer')->user()->id)->update([
                'password'=> bcrypt($request->password),
            ]);
            return back()->with('update','password update done');
        }
        else{
            return back()->with('err','current password not match');
        }
    }
}
