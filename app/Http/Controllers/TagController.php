<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    //tags 

    function tags(){
        $tags = tag::paginate(10);
        return view('admin.tags.tags',[
            'tags'=>$tags,
        ]);
    }

    //tag store
    function tag_store(Request $request){

        $request->validate([
            'tag_name.*'=>['required',Rule::unique('tags','tag_name')],
        ],[
            'tag_name.*.required'=> 'plz fill the input',
            'tag_name.*.unique'=> 'tag name must be unique',
        ]);


        $tags = $request->tag_name;

        foreach($tags as $tag){
            Tag::insert([
                'tag_name'=>$tag,
                'created_at'=>Carbon::now(),
            ]);
        }

        return back()->with('success', 'tag add successfuly');
    }

    //tag delete
    function tag_delete($id){

        Tag::find($id)->delete();
        return back()->with('delete','tag delete done');
    }
}
