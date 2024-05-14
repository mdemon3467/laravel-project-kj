<?php

namespace App\Http\Controllers;

use App\Models\color;
use App\Models\inventory;
use App\Models\Product;
use App\Models\size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    //variation page
    function add_variation(){
        $colors = color::all();
        $sizes = size::all();
        return view('admin.variation.add_variation',[
            'colors'=> $colors,
            'sizes'=> $sizes,
        ]);
    }

    //add color
    function add_color(Request $request){
        $request->validate([
            'color_name'=> 'required',
        ]);
        color::insert([
            'color_name'=> $request->color_name,
            'color_code'=> $request->color_code,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('success','color add successfuly');
    }

    //add size
    function add_size(Request $request){
        $request->validate([
            'size'=> 'required',
        ]);
        size::insert([
            'size'=> $request->size,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('success2','size add successfuly');
    }
    
    // //color delete
    function color_delete($id){
        color::find($id)->delete();
        return back()->with('delete','color delete successfuly');
    }

    // //color size
    function size_delete($id){
        size::find($id)->delete();
        return back()->with('delete2','size delete successfuly');
    }

    //product inventory add
    function add_inventory($id){

        $products = Product::find($id);
        $colors = color::all();
        $sizes = size::all();
        $inventories = inventory::where('product_id',$id)->get();

        return view('admin.products.inventory',[
            'products'=>$products,
            'colors'=> $colors,
            'sizes'=> $sizes,
            'inventories'=> $inventories,
        ]);
    }

    //inventory store
    function inventory_store(Request $request ,$id){

        $request->validate([
            'color_id'=>'required',
            'size_id'=>'required',
            'quantity'=>'required',
            'price'=>'required',
        ],[
            'color_id.required'=>'plz select a color',
            'size_id.required'=>'plz select a size', 
            'quantity.required'=>'plz inter product quantity', 
            'price.required'=>'plz inter product price',  
        ]);

        //for diccount
        // $products = Product::find($id);
        // echo $request->price - ($request->price * ($products->discount / 100));
        if(inventory::where('product_id',$id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists())
        {
            inventory::where('product_id',$id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
        
            return back()->with('success','inventory add successfuly');
        }
        else {
            $products = Product::find($id);
            inventory::insert([
                'product_id'=>$products->id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
                'quantity'=>$request->quantity,
                'price'=>$request->price,
                'after_discount'=>$request->price - ($request->price * ($products->discount / 100)),
                'created_at'=>Carbon::now(),
            ]);
    
            return back()->with('success','inventory add successfuly');
        }

    }

    function inventory_delete($id){
        inventory::find($id)->delete();
        return back()->with('delete','inventory delete successfuly');
    }

    
}
