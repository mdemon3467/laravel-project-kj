@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>
                    Countdown List
                </h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Product name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">After discount</th>
                    <th scope="col">Image</th>
                    <th scope="col">Event End date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->price}}</</td>
                    <td>-{{$product->discount}}%</</td>
                    <td>{{$product->after_discount}}</</td>
                    <td>
                        <img src="{{asset('uploads/countdown/'.$product->bg_image)}}" alt="">
                    </td>
                    <td id="time" value="{{$product->end_date}}">{{$product->end_date}}</</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>
                    Count-down offer
                </h3>
            </div>
            @if (session('success'))
                <strong class="alert alert-success">{{session('success')}}</strong>
            @endif
            <div class="card-body">
                <form action="{{route('countdown.store',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}">
                        @error('product_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price" value="{{$product->price}}">
                        @error('price')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Discount</label>
                        <input type="number" class="form-control" name="discount" value="{{$product->discount}}">
                        @error('discount')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">End Date</label>
                        <input type="datetime" class="form-control" name="end_date" value="{{$product->end_date}}">
                        @error('end_date')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Background image</label>
                        <input type="file" class="form-control" name="bg_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('bg_image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <img src="{{asset('uploads/countdown/'.$product->bg_image)}}" id="blah" width="100">
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


