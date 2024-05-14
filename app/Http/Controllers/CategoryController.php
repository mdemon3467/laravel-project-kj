<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

use function Laravel\Prompts\alert;

class CategoryController extends Controller
{
    // add category page
    function add_category(){
        return view('admin.categories.add_category');
    }

    //category list
    function category_list(){
        $categorys = category::all();
        return view('admin.categories.category_list',[
            'categorys'=>$categorys,
        ]);
    }

    //category store
    function category_store(Request $request){

        // show all data
        // print_r($request->all());

        $request->validate([
            'category_name'=>'required | unique:categories',
            'category_photo'=>['required','mimes:png,jpg,gif,jpeg','max:1024','image']
        ],[
            'category_name.required'=>'plz inter a name',
            'category_photo.required'=>'plz inter a photo',
            'category_photo.mimes'=>'only allowed png,jpg,gif,jpeg',
            'category_photo.max'=>'max photo size 1 mb',
            'category_photo.image'=>'only allowed image type',
        ]);

        $slug =Str::lower(str_replace(' ','-',$request->category_name).'-'.random_int(22222,99999));


        $img = $request->category_photo;
        $extension = $img->extension();
        
        $file_name = uniqid().'.'.$extension;
        Image::make($img)->resize(500,500)->save(public_path('uploads/category/'.$file_name));

        category::insert([
            'category_name'=>$request->category_name,
            'category_photo'=>$file_name,
            'slug'=> $slug,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('submit','new category added successfuly');
    }

    //category delete
    function category_delete($id){

        category::find($id)->delete();

        return back()->with('delete', 'category delete done');
    }

    //category edit page
    function category_edit($id){
        $category = category::find($id);
        return view('admin.categories.edit_category',[
            'category'=>$category,
        ]);
    }

        
    //category update
    function category_update(Request $request, $id){

        $slug =Str::lower(str_replace(' ','-',$request->category_name).'-'.random_int(22222,99999));

        if($request->category_photo ==''){
            $request->validate([
                'category_name'=>'required | unique:categories',
            ],[
                'category_name.required'=>'plz inter a name',
            ]);

            category::find($id)->update([
                'category_name'=>$request->category_name,
                'slug'=> $slug,
            ]);

            return back()->with('update','category edit successfuly');
        }
        else {

            $img = category::find($id);
            $delete_form = public_path('uploads/category/'.$img->category_photo);
            unlink($delete_form);

            $request->validate([
                'category_name'=>'required | unique:categories',
                'category_photo'=>['required','mimes:png,jpg,gif,jpeg','max:1024','image']
            ],[
                'category_name.required'=>'plz inter a name',
                'category_photo.required'=>'plz inter a photo',
                'category_photo.mimes'=>'only allowed png,jpg,gif,jpeg',
                'category_photo.max'=>'max photo size 1 mb',
                'category_photo.image'=>'only allowed image type',
            ]);
    
    
            $img = $request->category_photo;
            $extension = $img->extension();
            
            $file_name = uniqid().'.'.$extension;
            Image::make($img)->resize(500,500)->save(public_path('uploads/category/'.$file_name));
    
            category::find($id)->update([
                'category_name'=>$request->category_name,
                'category_photo'=>$file_name,
                'slug'=> $slug,
            ]);
    
            return back()->with('update','category update successfuly');
        }

    }

    //trash category list
    function category_trash(){

        $category = category::onlyTrashed()->get();
        return view('admin.categories.trash_category',[
            'categories'=>$category,
        ]);
    }

    //category_check_delete
    function category_check_delete(Request $request){
        $category = $request->category_id;

        foreach ($category as $cat_id ){
            category::find($cat_id)->delete();
        }
        return back()->with('delete', 'category delete done');
    }

    // category restore
    function category_restore($id){

        category::onlyTrashed()->find($id)->restore();
        return back()->with('restore','category has been restore');
            
    }

    //ategory_parmanent_delete
    function category_parmanent_delete($id){

        $img = category::onlyTrashed()->find($id);
        $delete_form = public_path('uploads/category/'.$img->category_photo);
        unlink($delete_form);
        category::onlyTrashed()->find($id)->forceDelete();
        subcategory::where('category_id',$id)->delete();
        
        return back()->with('parmanet','category has parmanent delete');
    }


    // category_check_restore
    function category_check_restore(Request $request){
        if($request->btn =='restore'){
            $category = $request->category_id;
            foreach ($category as $cat_id ){
                category::onlyTrashed()->find($cat_id)->restore();
            }
            return back()->with('restore','category has been restore');
        }
        else{
            $category = $request->category_id;

            foreach ($category as $cat_id ){
                $img = category::onlyTrashed()->find($cat_id);
                    $delete_form =public_path('uploads/category/'.$img->category_photo);
                    unlink($delete_form);
                category::onlyTrashed()->find($cat_id)->forceDelete();
                subcategory::where('category_id',$cat_id)->delete();
            }
            return back()->with('parmanet','category has parmanent delete');
        }

    }
}
