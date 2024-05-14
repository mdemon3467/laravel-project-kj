@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Subcategory list</h3>
            </div>
            @if(session('delete'))
            <div class="alert alert-danger">{{session('delete')}}</div>
            @endif
            <div class="card-body">
                <div class="row">
                    @foreach ($categoryies as $category)
                    <div class="col-lg-6">
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3>{{$category->category_name}}</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Subcategory name</th>
                                        <th>Action</th>
                                    </tr>                                  
                                    <tr>
                                        @foreach (App\Models\subcategory::where('category_id',$category->id)->get() as $subcategory)
                                        <tr>
                                            <td>{{$subcategory->subcategory_name}}</td>
                                            <td>
                                                <a title="edit" href="{{route('subcategory.edit',$subcategory->id)}}" class="btn btn-primary btn-icon animation1">
                                                    <i data-feather="edit"></i>
                                                </a>                                
                                                <a title="delete" href="{{route('subcategory.delete',$subcategory->id)}}" class="btn btn-danger btn-icon">
                                                    <i data-feather="trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tr>                         
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add subcategory</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            <div class="card-body">
                <form action="{{route('subcategory.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Select Category</label>
                        <select name="category_id" class="form-control">
                            <option value="" >Select option</option>
                            @foreach ($categoryies as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">SubCategory Name</label>
                        <input type="text" class="form-control" name="subcategory_name">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
