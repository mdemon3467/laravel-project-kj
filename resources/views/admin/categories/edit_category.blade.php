@extends('layouts.admin')
@section('content')

<div class="col-lg-8 m-auto">
    <div class="card">
        <div class="card-header">
            <h3>edit Category</h3>
        </div>
        @if (session('update'))
        <strong class="alert alert-success">{{session('update')}}</strong>
        @endif
        <div class="card-body">
            <form action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category_name</label>
                    <input type="text" name="category_name" class="form-control" value="{{$category->category_name}}">
                </div>
                    <div class="mt-3 mb-3">
                        @error('category_name')
                            <strong class="alert alert-danger">{{$message}}</strong>
                        @enderror
                    </div>
                <div class="mb-3">
                    <label for="category_photo" class="label-control">Category_photo</label>
                    <input type="file" name="category_photo" class="form-control"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <div class="mt-3 mb-3">
                    @error('category_photo')
                        <strong class="alert alert-danger">{{$message}}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <img src="{{asset('uploads/category/')}}/{{$category->category_photo}}" id="blah" width="100">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary ">update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer_script')

@if(session('update'))
<script>
    Swal.fire({
    title: "Edit!",
    text: "Your file has been update.",
    icon: "success"
});
</script>
@endif
@endsection