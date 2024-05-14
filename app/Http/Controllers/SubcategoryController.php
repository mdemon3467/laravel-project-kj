<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    //subcategory add
    function sub_category(){
        $category = category::all();

        return view('admin.subcategory.subcategory',[
            'categoryies'=>$category,
        ]);
    }

    //subcategory store
    function subcategory_store(Request $request){
        subcategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('success','subcategory_store successfuly');
    }

    //subcategory edit
    function subcategory_edit($id){

        $subcategory = subcategory::find($id);

        return view('admin.subcategory.edit_subcategory',[
            'subcategoryies'=>$subcategory,
        ]);
    }

    //subcategory_edit_store
    function subcategory_edit_store(Request $request, $id){
        subcategory::find($id)->update([
            'subcategory_name'=>$request->subcategory_name,
        ]);

        return back()->with('success','subcategory edit successfuly');
    }

    //subcategory delete
    function subcategory_delete($id){

        subcategory::find($id)->delete();

        return back()->with('delete','subcategory has been delete');
    }

}
