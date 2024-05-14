<?php

namespace App\Http\Controllers;

use App\Models\countdown;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class OfferController extends Controller
{
    //coundown page
    function count_down()
    {
        $product = countdown::first();
        return view('admin.Exciting Offers.count_down.count_down',[
            'product'=>$product,
        ]);
    }

    //coundown store
    function count_down_store(Request $request ,$id){
        $request->validate([
            'product_name'=>'required',
            'price'=>'required',
            'discount'=>'required',
            'end_date'=>'required',
            'bg_image'=>['required', 'mimes:png,jpg,gif','max:1024','image'],
        ],[
            'bg_image.required'=>'plz inter a backgrount image',
        ]);

        $image = countdown::find($id);
        $delete_form = public_path('uploads/countdown/'.$image->bg_image);
        unlink($delete_form);

        $img = $request->bg_image;
        $extension = $img->extension();

        $file_name = uniqid().'.'.$extension;

        Image::make($img)->resize(648,350)->save(public_path('uploads/countdown/'.$file_name));

        countdown::find($id)->update([
            'product_name'=>$request->product_name,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'after_discount'=>$request->price - ($request->price * ($request->discount/100)),
            'end_date'=>$request->end_date,
            'bg_image'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);


        return back()->with('success','product add successfuly');

    }

        //discount event
        function discount_event()
        {
            $Event = Event::first();
            return view('admin.Exciting Offers.discount_event.discount_event',[
                'Event'=>$Event,
            ]);
        }

        //coundown store
    function discount_event_store(Request $request, $id){
        $request->validate([
            'event_name'=>'required',
            'discount'=>'required',
            'bg_image'=>['required', 'mimes:png,jpg,gif','max:1024','image'],
        ],[
            'bg_image.required'=>'plz inter a backgrount image',
        ]);

        $image = Event::find($id);
        $delete_form = public_path('uploads/discount_event/'.$image->bg_image);
        unlink($delete_form);

        $img = $request->bg_image;
        $extension = $img->extension();

        $file_name = uniqid().'.'.$extension;

        Image::make($img)->resize(648,350)->save(public_path('uploads/discount_event/'.$file_name));

        Event::find($id)->update([
            'event_name'=>$request->event_name,
            'discount'=>$request->discount,
            'bg_image'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);


        return back()->with('success','Event add successfuly');

    }
}
