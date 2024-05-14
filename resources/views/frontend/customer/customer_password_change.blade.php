@extends('frontend.master')
@section('header_css')
<style>
    .location {
        margin: 30px 0px 30px 120px;
        font-family: "Muli";
        font-weight: 600;
        font-size: 20px;
        color: #233D50;
        line-height: 25px;
    }
    .location i {
        padding: 0px 10px 0px 10px;
    }
    .image {
        margin-bottom: 20px;
    }
    .image p {
        font-size: 18px;
        text-align: center;
        color: #233D50;
        font-family: "Muli";
        font-weight: 600;
    }
    .img-profile {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 2px solid rgb(74, 240, 9);
        margin: 0px 0px 10px 90px;
        background-color: red;
    }
    .img-profile img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        background-color: red;
    }
    .dashboard {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        gap: 10px;
    }
    .dashboard div {
        border-bottom: 2px solid royalblue;
        padding-bottom: 3px;
    }
</style>
@endsection
@section('content')
<div class="location">
    Home<i class="fa fa-angle-right" aria-hidden="true"></i>My Account
</div>
<div class="row" style="margin-left: 25px">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h3 style="padding-left: 30px">My Account Details</h3>
            </div>
            <div class="card-body">
                <div class="image">
                    @if(Auth::guard('customer')->user()->photo == null)
                    <div class="img-profile"><img src="{{ Avatar::create(Auth::guard('customer')->user()->name)->toBase64() }}" /></div>
                @else 
                <div class="img-profile"><img src="{{asset('uploads/customer/')}}/{{Auth::guard('customer')->user()->photo}}" alt="Profile Picture"></div>
                @endif
                    
                    <p>{{Auth::guard('customer')->user()->name}}</p>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="dashboard">
                                <div><a href="{{route('customer.profile')}}"> Profile</a></div>
                                <div>Purchases</div>
                                <div>My Wishlist</div>
                                <div><a href="{{route('customer.profile.edit')}}">Profile Change</a></div>
                                <div><a href="{{route('customer.password.change')}}">Password Change</a></div>
                                <div><a href="{{route('customer.logout')}}">LogOut</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Customer Password Change</h3>
            </div>

            @if(session('err'))
            <strong class="alert alert-danger">{{session('err')}}</strong>
            @endif
            @if(session('update'))
            <strong class="alert alert-success">{{session('update')}}</strong>
            @endif
            
            <div class="card-body">
                <form action="{{route('customer.new.password')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 pb-3">
                            <label for="">Old Password</label>
                            <input  type="password" name="old_password" id="" class="form-control">
                            @error('old_password')
                                <strong class="text-danger">{{$message}}</strong>    
                            @enderror
                        </div>
                        <div class="col-lg-6 pb-3">
                            <label for="">New Password</label>
                            <input  type="password" name="password" id="" class="form-control">
                            @error('password')
                                <strong class="text-danger">{{$message}}</strong>    
                            @enderror
                        </div>
                        <div class="col-lg-6 pb-3 m-auto">
                            <label for="">Confirnm Password</label>
                            <input  type="password" name="password_confirmation" id="" class="form-control">
                            @error('password_confirmation')
                                <strong class="text-danger">{{$message}}</strong>    
                            @enderror
                        </div>
                    <div class="text-center p-3">
                        <button type="submit" style="text:center" class="btn btn-primary">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
