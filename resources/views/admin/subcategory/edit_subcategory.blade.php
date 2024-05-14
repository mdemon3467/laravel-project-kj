@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>edit subcategory</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            <div class="card-body">
                <form action="{{route('subcategory.edit.store',$subcategoryies->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">SubCategory Name</label>
                        <input type="text" class="form-control" name="subcategory_name" value="{{$subcategoryies->subcategory_name}}">
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