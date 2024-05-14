@extends('frontend.master')
@section('content')
<!-- start wpo-page-title -->
<section class="wpo-page-title">
    <h2 class="d-none">Hide</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="{{route('welcome')}}">Home</a></li>
                        <li>{{$category->category_name}}</li>
                        <li>{{$subcategory->subcategory_name}}</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- start of themart-interestproduct-section -->
<section class="themart-interestproduct-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="wpo-section-title">
                    <h2>{{$subcategory->subcategory_name}} Product</h2>
                </div>
            </div>
        </div>
        <div class="product-wrap">
            <div class="row">
                @foreach ($subcategory_products as $pro)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="product-item">
                        <div class="image">
                            <img src="{{asset('uploads/product/preview/'.$pro->preview)}}" alt="">
                            @if ($pro->discount)
                            <div class="tag sale">-{{$pro->discount}}%</div>
                            @else
                                <div class="tag new">New</div>
                            @endif
                        </div>
                        @php
                            $length = Str::length($pro->product_name);
                        @endphp
                        <div class="text">
                            <h2><a href="{{route('product.details',$pro->slug)}}">{{$length >= '25'? Str::substr($pro->product_name, 0, 20).'...' : $pro->product_name}}</a></h2>
                            <div class="rating-product">
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <span>130</span>
                            </div>
                            <div class="price">
                                @if ($pro->discount)
                                    <span class="present-price">&#2547;{{$pro->rel_to_inventory->first()->after_discount}}</span>
                                    <del class="old-price">&#2547;{{$pro->rel_to_inventory->first()->price}}</del>
                                @else
                                    <span class="present-price">&#2547;{{$pro->rel_to_inventory->first()->after_discount}}</span>
                                @endif
                            </div>
                            <div class="shop-btn">
                                <a class="theme-btn-s2" href="{{route('product.details',$pro->slug)}}">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="more-btn">
                    <a class="theme-btn-s2" href="product.html">Load More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of themart-interestproduct-section -->

@endsection