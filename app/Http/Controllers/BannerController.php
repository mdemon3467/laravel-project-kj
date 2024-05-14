<?php

namespace App\Http\Controllers;

use App\Models\banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    //banner page
    function banner()
    {
        $banner = banner::all();
        return view('admin.banner.banner',[
            'banner'=>$banner,
        ]);
    }

    //banner store
    function banner_store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'banner_photo'=>['required','max:1024','mimes:png,jpg,gif','image'],
        ]);

       $image = $request->banner_photo;
       $extension = $image->extension();
       $file_name = uniqid().'.'.$extension;

       Image::make($image)->resize(931,600)->save(public_path('uploads/banner/'.$file_name));

       banner::insert([
            'tittle'=>$request->title,
            'banner_photo'=>$file_name,
            'created_at'=>Carbon::now(),
       ]);

       return back()->with('success','banner add successfuly');
    }

    //banner delete
    function banner_delete($id){
        $image = banner::find($id);
        $delete_form = public_path('uploads/banner/'.$image->banner_photo);
        unlink($delete_form);

        banner::find($id)->delete();

        return back()->with('delete','banner delete successfuly');        
    }
}
