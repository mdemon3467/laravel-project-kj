@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h3>Brands list</h3>
                </div>
                @if (session('delete'))
                    <strong class="alert alert-success">{{session('delete')}}</strong>            
                @endif
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $sl=> $brand)
                                <tr>
                                    <td>{{$sl+1}}</td>
                                    <td>{{$brand->brand_name}}</td>
                                    <td>
                                        <img src="{{asset('uploads/brand/')}}/{{$brand->brand_photo}}"></td>
                                    <td>                                                
                                        <a title="delete" href="{{route('brand.delete',$brand->id)}}" class="btn btn-danger btn-icon">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add new brands</h3>
                </div>
                    @if(session('success'))
                        <strong class="alert alert-success">{{session('success')}}</strong>
                    @endif
                <div class="card-body">
                    <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="">Brand name</label>
                            <input type="text" name="brand_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            @error('brand_name')
                                <strong class="alert alert-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Brand photo</label>
                            <input type="file" name="brand_photo" class="form-control">
                        </div>
                        <div class="mb-3">
                            @error('brand_photo')
                                <strong class="alert alert-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection