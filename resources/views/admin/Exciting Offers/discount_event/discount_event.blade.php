@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
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
                    <th scope="col">Image</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{$Event->event_name}}</td>
                    <td>-{{$Event->discount}}%</</td>
                    <td>
                        <img src="{{asset('uploads/discount_event/'.$Event->bg_image)}}" alt="">
                    </td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>
                    Create Event
                </h3>
            </div>
            @if (session('success'))
                <strong class="alert alert-success">{{session('success')}}</strong>
            @endif
            <div class="card-body">
                <form action="{{route('discount.event.store',$Event->id)}}" method="POST" enctype="multipart/form-data">
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
                        <label for="">Background image</label>
                        <input type="file" class="form-control" name="bg_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('bg_image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <img src="{{asset('uploads/discount_event/'.$Event->bg_image)}}" id="blah" width="100">
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


