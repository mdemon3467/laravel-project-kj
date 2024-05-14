<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\subcategory;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Stmt\Foreach_;

class ProductController extends Controller
{
    //products
    function product(){
        $products = product::all();
        $categoryies = category::all();
        $subcategoryies = subcategory::all();
        $brands = Brand::all();
        $tags = Tag::all();
        return view('admin.products.product',[
            'categoryies'=>$categoryies,
            'subcategoryies'=>$subcategoryies,
            'brands'=>$brands,
            'tags'=>$tags,
            'products'=>$products,
        ]);
    }
    //subcategory selection based on category
    function getsubcategory(Request $request){
        $sub = $request->category_id;
        $string = '<option value="">Select subcategory name</option>';

        $subcategories = subcategory::where('category_id',$sub)->get();
        foreach($subcategories as $subcategory){
            $string .='<option value="'.$subcategory->id.'">' .$subcategory->subcategory_name. '</option>';
        }
        return $string;
    }

    //product_store
    function product_store(Request $request){

        $request->validate([
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'brand_id'=>'required',
            'product_name'=>'required',
            'sku'=>'required',
            'discount'=>'required',
            'short_desp'=>'required',
            'long_desp'=>'required',
            'aditional'=>'required',
            'tag_id.*'=>'required',
            'preview'=>'required',
            'gallery.*'=>'required',
        ]);

        $tags = $request->tag_id;
        $after_implode = implode(',',$tags);

        $slug = Str::lower(str_replace(' ','-',$request->product_name).'-'.random_int(22222,99999));

        $preview = $request->preview;
        $extension = $preview->extension();
        $file_name = uniqid().'.'.$extension;

        Image::make($preview)->resize(700, 700)->save(public_path('uploads/product/preview/'.$file_name));


        $product_id = Product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'brand_id'=>$request->brand_id,
            'product_name'=>$request->product_name,
            'sku'=>$request->sku,
            'discount'=>$request->discount,
            'short_desp'=>$request->short_desp,
            'long_desp'=>$request->long_desp,
            'aditional'=>$request->aditional,
            'tags'=>$after_implode,
            'preview'=>$file_name,
            'slug'=>$slug,
            'created_at'=>Carbon::now(),
        ]);

            //gallery img process
            $gallery = $request->gallery;

            foreach($gallery as $gal){

            $extension2 = $gal->extension();
            $file_name2 = Str::lower(str_replace(' ','-',$request->product_name).'-'.random_int(22222,99999)).'.'.$extension2;

            Image::make($gal)->resize(700,700)->save(public_path('uploads/product/gallery/'.$file_name2));

            Gallery::insert([
                'product_id'=>$product_id,
                'gallery_name'=>$file_name2,
                'created_at'=>Carbon::now(),
            ]);
            }

        return back()->withsuccess('product add successfuly');
    }

    //product view
    function product_list(){
        $products = Product::all();
        $gallery = Gallery::all();
        return view('admin.products.product_list',[
            'products'=>$products,
            'gallery'=>$gallery,
        ]);
    }

    //product_view
    function product_view($id){
        $product_info = Product::find($id);
        return view('admin.products.product_view',[
            'product_info'=>$product_info,
        ]);
    }

        //product_delete
        function product_delete($id){

            $gallery = Gallery::where('product_id',$id)->get(); //delete korle age get kortw hoy pore delete
            
            foreach($gallery as $gal_id){
                echo $gal_id.'<br>';
                $delete_form_gallery = public_path('uploads/product/gallery/'.$gal_id->gallery_name);
                unlink($delete_form_gallery);
                Gallery::where('product_id',$id)->delete(); 

            }

            $preview = Product::find($id);
            $delete_form_preview = public_path('uploads/product/preview/'.$preview->preview);
            unlink($delete_form_preview);

            Product::find($id)->delete();

            return back()->with('success','Product delete successfuly');
        }

        //product edit
        function product_edit($id){
            $products = product::find($id);
            $categoryies = category::all();
            $subcategoryies = subcategory::all();
            $brands = Brand::all();
            $tags = Tag::all();
            return view('admin.products.product_edit',[
                'categoryies'=>$categoryies,
                'subcategoryies'=>$subcategoryies,
                'brands'=>$brands,
                'tags'=>$tags,
                'products'=>$products,
            ]);
        }


        //product_update
        function product_update(Request $request,$id){
            print_r($request->all());
        }
}
