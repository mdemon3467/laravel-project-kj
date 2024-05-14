<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;
// use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{
    //user profile view
    function edit_profile(){
        return view('admin.user.edit_profile');
    }

    //user profile name update
    function update_profile(Request $request){

        //for single value to show
        // echo $request->name;

        // print_r($request->all());
        
        // for email validation
        // $request->validate([
        //     'email'=>'unique:users',
        // ]);

        user::find(Auth::id())->update([
            'name'=> $request->name,
        ]);

        return back()-> with('success','user name update succes fully');
    }

    //user password update
    function update_password(Request $request){
        $request->validate([
            'current_password'=>'required',
            'password'=>['required',Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(),'confirmed'],
            // ar nam 'password_confirmation na dile confirm match function kaj kore na
            'password_confirmation'=>'required',
        ]);

        if(password_verify($request->current_password,Auth::user()->password)){
            user::find(Auth::id())->update([
                'password'=> bcrypt($request->password),
            ]);
            return back()->with('update','password update done');
        }
        else {
            return back()->with('err','current password not match');
        }
    }

    //user image update
    function update_image(Request $request){

        $request->validate ([
            'image'=>['required','mimes:png,jpeg,jpg,gif','max:1024',]
        ],[
            'image.required'=>'plz inter image first',
            'image.mimes'=>'image type must be jpg,png,jpeg,gif type',
            'image.max'=>'image size max 1mb allowed',
        ]);

        if(Auth::user()->photo != NULL){
            $delate_form = public_path('uploads/users/'.Auth::user()->photo);
            unlink($delate_form);
        }

        $image = $request->image;
        $extension = $image-> extension();

        $file_name = uniqid().'.'.$extension;

        Image::make($image)->resize(300, 200)->save(public_path('uploads/users/'.$file_name));

        user::find(Auth::id())->update ([
           'photo'=>$file_name,
        ]);

        return back()->with('update1','profile photo update done');
    }

    //user list show
    function user_list(){
        $users = user::all();
        return view('admin.user.user_list',compact('users'));
    }

    //user id and photo delete
    function delate_user($id){

         $user = user::find($id);
         
         if($user->photo != ''){
            $delate_form = public_path('uploads/users/'.$user->photo);
            unlink($delate_form);
         }
            
         user::find($id)->delete();
         return back()->with('delete','user id has been delete');
    }

    //add user
    function add_user(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>['required',Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(),'confirmed'],
            'password_confirmation'=>'required',
        ]);

        user::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('user','User add successfuly');
    }
}
