<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    //brands page
    function brand(){
        $brand = Brand::all();
        return view('admin.brand.brand',[
            'brands'=>$brand,
        ]);
    }

    //brand name input
    function brand_store(Request $request){

        $request->validate([
            'brand_name'=>'required',
            'brand_photo'=>['required','mimes:png,jpg,jpeg,gif','image','max:1024']
        ],[
            'brand_name.required'=> 'Inter a brand name first',
            'brand_photo.required'=>'plz inter a photo',
            'brand_photo.mimes'=>'only allowed png,jpg,gif,jpeg',
            'brand_photo.max'=>'max photo size 1 mb',
            'brand_photo.image'=>'only allowed image type',
        ]);

        $img = $request->brand_photo;
        $extension = $img->extension();

        $file_name = uniqid().'.'.$extension;

        Image::make($img)->save(public_path('uploads/brand/'.$file_name));

        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_photo'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('success', 'brand added successfuly');
    }

    //brand delete
    function brand_delete($id){

        $img = Brand::find($id);
        $delete_form = public_path('uploads/brand/'.$img->brand_photo);
        unlink($delete_form);

        brand::find($id)->delete();

        return back()->with('delete','brand delete successfuly');
    }
}
