@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>
                    Banner List
                </h3>
            </div>
            @if (session('delete'))
            <strong class="alert alert-success">{{session('delete')}}</strong>
            @endif
            <div class="card-body">
                <table class="table table-striped ">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">banner photo</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($banner as $sl=> $ban)
                        <tr>
                            <td>{{$sl+1}}</td>
                            <td>{{$ban->tittle}}</td>
                            <td><img src="{{asset('uploads/banner/'.$ban->banner_photo)}}" alt=""></td>
                            <td>
                                <a href="{{route('banner.delete',$ban->id)}}">
                                    <button title="trash" type="button" class="btn btn-danger btn-icon">
                                        <i data-feather="trash"></i>
                                    </button>
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
                <h3>
                    Add Banner
                </h3>
            </div>
            @if (session('success'))
                <strong class="alert alert-success">{{session('success')}}</strong>
            @endif
            <div class="card-body">
                <form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="">Banner Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="">Banner Photo</label>
                        <input type="file" class="form-control" name="banner_photo">
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