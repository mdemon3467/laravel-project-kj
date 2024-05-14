@extends('layouts.admin')
@section('content')
  <div class="row">
    <div class="col-8">
      <div class="card">
        <div class="card-header">
            <h3>all user list</h3>
        </div>
        @if (session('delete'))
            <strong class="alert alert-success">{{session('delete')}}</strong>
        @endif
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">sl</th>
                        <th scope="col">photo</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $sl => $user)
                    <tr>
                        <th scope="row">{{$sl+1}}</th>
                        <td>
                        @if($user->photo == null)
                            <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                        @else 
                            <img src="{{asset('uploads/users/')}}/{{$user->photo}}">
                        @endif
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><a href="{{route('delate.user',$user->id)}}" class="btn btn-danger">Delate</a></td>
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
                <h3>Add New User</h3>
            </div>
                @if(session('user'))
                    <strong class="alert alert-success">{{session('user')}}</strong>
                @endif
            <div class="card-body">
                <form action="{{route('add.user')}}" method="POST" >
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    @error('name')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                        @error('email')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
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
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection