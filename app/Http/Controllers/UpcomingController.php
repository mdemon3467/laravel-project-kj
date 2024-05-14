<?php

namespace App\Http\Controllers;

use App\Models\Upcoming;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UpcomingController extends Controller
{
    //upcomin event
    function upcoming_event()
    {
        $Event = Upcoming::first();
        return view('admin.upcoming_offer.upcoming_offer',[
            'Event'=>$Event,
        ]);    
    }

    //upcomin event store

        function upcoming_event_store(Request $request , $id)
        {
        $request->validate([
            'event_name'=>'required',
            'discount'=>'required',
            'model_image'=>['required', 'mimes:png,jpg,gif','max:1024','image'],
            'product_image'=>['required', 'mimes:png,jpg,gif','max:1024','image'],
        ],[
            'model_image.required'=>'plz inter a model image',
            'product_image.required'=>'plz inter a product image',
        ]);
 
        $image = Upcoming::find($id);

        $delete_form = public_path('uploads/upcoming_event/'.$image->model_image);
        unlink($delete_form);

        $delete_form1 = public_path('uploads/upcoming_event/'.$image->product_image);
        unlink($delete_form1);
 
        //model image
        $img1 = $request->model_image;
        $extension1 = $img1->extension();
 
        $file_name1 = uniqid().'.'.$extension1;
 
        Image::make($img1)->resize(377,478)->save(public_path('uploads/upcoming_event/'.$file_name1));
        
        //product image
        $img2 = $request->product_image;
        $extension2 = $img2->extension();
 
        $file_name2 = uniqid().'.'.$extension2;
 
        Image::make($img2)->resize(298,388)->save(public_path('uploads/upcoming_event/'.$file_name2));


        Upcoming::find($id)->update([
            'event_name'=>$request->event_name,
            'discount'=>$request->discount,
            'model_image'=>$file_name1,
            'product_image'=>$file_name2,
            'created_at'=>Carbon::now(),
        ]);
 
 
        return back()->with('success','Event add successfuly');
 
     }


}
