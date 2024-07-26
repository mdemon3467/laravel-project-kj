<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class CartController extends Controller
{
    //cart add
    function add_cart(Request $request, $product_id){
        $request->validate([
            'color_id'=>'Required',
            'size_id'=>'Required',
            'quantity'=>'Required',
        ]);
        Cart::insert([
            'customer_id'=>Auth::guard('customer')->user()->id,
            'product_id'=>$product_id,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
            'quantity'=>$request->quantity,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('cart', 'Cart added successfuly');

    }

    //cart delete
    function delete_cart($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }
}
