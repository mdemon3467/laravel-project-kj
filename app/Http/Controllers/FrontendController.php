<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\category;
use App\Models\color;
use App\Models\countdown;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\inventory;
use App\Models\Product;
use App\Models\subcategory;
use App\Models\Upcoming;
use Illuminate\Http\Request;
use App\Models\User;

class FrontendController extends Controller
{
    function welcome(){
        $categories = category::all();
        $products = Product::all()->take(8);
        $recent_products = Product::latest()->take(3)->get();
        $banners = banner::all();
        $countdowns = countdown::all();
        $event = Event::all();
        $upcoming_event = Upcoming::all();
        return view('frontend.index',[
            'categories'=>$categories,
            'products'=>$products,
            'banners'=>$banners,
            'countdowns'=>$countdowns,
            'event'=>$event,
            'upcoming_event'=>$upcoming_event,
            'recent_products'=>$recent_products,
        ]);
    }

    //product details
    function product_details($slug){

        $product = Product::where('slug',$slug)->get(); //sob detail get korar jonno
        $product_id = $product->first()->id; //id ta get korar jonno
        $product_info =  Product::find($product_id); //id theke sob detail pathanor jonno
        $gallaries = Gallery::where('product_id',$product_id)->get();

        $available_color = inventory::where('product_id',$product_id)

        //koyta color ase sudu ta dekha jay
        // ->groupBy('color_id')
        // ->selectRaw('sum(color_id) as color_id')

        ->groupBy('color_id')
        ->selectRaw('count(*) as total, color_id')
        ->get();

        $available_size = inventory::where('product_id',$product_id)

        //koyta color ase sudu ta dekha jay
        // ->groupBy('color_id')
        // ->selectRaw('sum(color_id) as color_id')

        ->groupBy('size_id')
        ->selectRaw('count(*) as total, size_id')
        ->get();
        return view('frontend.product_details',[
            'product_info'=>$product_info,
            'gallaries'=>$gallaries,
            'available_color'=>$available_color,
            'available_size'=>$available_size,
        ]);
    }

    //get color
    function get_color(Request $request){
        $sizes = inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        
        $str = '';
        foreach($sizes as $size){
            if($size->rel_to_size->size == 'N/A'){
                $str .='<li class="color"><input checked id="size'.$size->size_id.'" type="radio" name="size_id" value="'.$size->size_id.'">
                <label for="size'.$size->size_id.'">N/A</label></li>';
            }
            else{
                $str.='<li class="color"><input id="size'.$size->size_id.'" type="radio" name="size_id" value="'.$size->size_id.'">
                <label for="size'.$size->size_id.'">'.$size->rel_to_size->size.'</label></li>';
            }
        }
        echo $str;
    }

    //category_wise_product
    function category_wise_product($slug){

        $category = category::where('slug',$slug)->get();
        $categoty_id = $category->first()->id;
        $product = Product::where('category_id',$categoty_id)->get();
        $category_name = category::find($categoty_id);

        return view('frontend.category_wise_product',[
            'product'=>$product,
            'category_name'=>$category_name,
        ]);

    }

    //subcategory_wise_product
    function subcategory_wise_product($id){

        $subcategory = subcategory::find($id);
        $subcategory_products = Product::where('subcategory_id',$subcategory->id)->get();
        $category_id = $subcategory->rel_to_category->id;
        $category = category::find($category_id);

        return view('frontend.subcategory_wise_product',[
            'subcategory_products'=>$subcategory_products,
            'category'=>$category,
            'subcategory'=>$subcategory,
        ]);

    }    

    //discpunt_product_50
    function discount_product_50(){
        $products = Product::where('discount', '>', 5)->get();


        return view('frontend.discount_product_50',[
            'products'=>$products,
        ]);
    }

        //discpunt_product_70
        function discount_product_70(){
            $products = Product::where('discount', '>', 30)->get();
    
    
            return view('frontend.discount_product_70',[
                'products'=>$products,
            ]);
        }

        // view all product
        function view_all_products(){
            $products = Product::latest()->get();

            return view('frontend.view_all_product',[
                'products'=>$products,
            ]);
        }

}
