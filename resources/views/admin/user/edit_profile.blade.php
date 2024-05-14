@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>name and email update</h3>
            </div>
                @if(session('success'))
                    <strong class="alert alert-success">{{session('success')}}</strong>
                @endif
            <div class="card-body">
                <form action="{{route('update.profile')}}" method="POST" >
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" value="{{Auth::user()->email}}">
                        @error('email')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>new password update</h3>
            </div>
                @if(session('update'))
                    <strong class="alert alert-success">{{session('update')}}</strong>
                @endif
            <div class="card-body">
                <form action="{{route('update.password')}}" method="POST" >
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">current password</label>
                        <input type="password" name="current_password" class="form-control">
                        @error('current_password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        @if(session('err'))
                            <strong class="text-danger">{{session('err')}}</strong>
                        @endif
                    </div>
                    <div class="mb-3 pass">
                        <label for="password" class="form-label">password</label>
                        <input type="password" name="password" class="form-control" id="pass">
                        <i class="fa fa-eye password"></i>
                        @error('password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="_password" class="form-label">password_confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        @error('current_confirmation')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>update profile image</h3>
            </div>
                @if(session('update1'))
                    <strong class="alert alert-success">{{session('update1')}}</strong>
                @endif
            <div class="card-body">
                <form action="{{route('update.image')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">image</label>
                        <input type="file" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('image')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <img src="{{asset('uploads/users')}}/{{Auth::user()->photo}}" id="blah" width="100">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection