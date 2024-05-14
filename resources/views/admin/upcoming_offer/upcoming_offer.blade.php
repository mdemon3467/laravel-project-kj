@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h3>
                    Event List
                </h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Event name</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Model Image</th>
                    <th scope="col">Product Image</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{$Event->event_name}}</td>
                    <td>-{{$Event->discount}}%</</td>
                    <td>
                        <img src="{{asset('uploads/upcoming_event/'.$Event->model_image)}}" alt="">
                    </td>
                    <td>
                        <img src="{{asset('uploads/upcoming_event/'.$Event->product_image)}}" alt="">
                    </td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h3>
                    Upcoming Event Name
                </h3>
            </div>
            @if (session('success'))
                <strong class="alert alert-success">{{session('success')}}</strong>
            @endif
            <div class="card-body">
                <form action="{{route('upcoming.event.store',$Event->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="">Event_name</label>
                        <input type="text" class="form-control" name="event_name" value="{{$Event->event_name}}">
                        @error('event_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Discount</label>
                        <input type="number" class="form-control" name="discount" value="{{$Event->discount}}">
                        @error('discount')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Model image</label>
                        <input type="file" class="form-control" name="model_image" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">
                        @error('model_image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Product image</label>
                        <input type="file" class="form-control" name="product_image" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                        @error('product_image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="mb-3">
                            <h5>Model image</h5>
                            <img src="{{asset('uploads/upcoming_event/'.$Event->model_image)}}" id="blah1" width="100">
                        </div>
                        <div class="mb-3">
                            <h5>Product Image</h5>
                            <img src="{{asset('uploads/upcoming_event/'.$Event->product_image)}}" id="blah2" width="100">
                        </div>
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


