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
    .dashboard a {
        color: #233D50;
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
                <h3>Profile Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 pb-3">
                        <label for="">User Name</label>
                        <input  type="text" disabled name="" id="" class="form-control" value="{{Auth::guard('customer')->user()->name}}">
                    </div>
                    <div class="col-lg-6 pb-3">
                        <label for="">Email</label>
                        <input  type="text" disabled name="" id="" class="form-control" value="{{Auth::guard('customer')->user()->email}}">
                    </div>
                    <div class="col-lg-6 pb-3">
                        <label for="">Phone</label>
                        <input  type="text" disabled name="" id="" class="form-control" value="{{Auth::guard('customer')->user()->phone}}">
                    </div>
                    <div class="col-lg-6 pb-3">
                        <label for="">Country</label>
                        <input  type="text" disabled name="" id="" class="form-control" value="{{Auth::guard('customer')->user()->country_id ? Auth::guard('customer')->user()->rel_to_country->name : ''}}">
                    </div>
                    <div class="col-lg-6 pb-3">
                        <label for="">City</label>
                        <input  type="text" disabled name="" id="" class="form-control" value="{{Auth::guard('customer')->user()->city_id ? Auth::guard('customer')->user()->rel_to_city->name : ''}}">
                    </div>
                    <div class="col-lg-6 pb-3">
                        <label for="">Address</label>
                        <input  type="text" disabled name="" id="" class="form-control" value="{{Auth::guard('customer')->user()->address}}">
                    </div>
                    <div class="col-lg-6">
                        <label for="">Zip Code</label>
                        <input  type="text" disabled name="" id="" class="form-control" value="{{Auth::guard('customer')->user()->zip}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection