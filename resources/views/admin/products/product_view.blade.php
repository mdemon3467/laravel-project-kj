@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Product List</h3>
                <a class="btn btn-primary mt-2" href="{{route('product.list')}}">Product list</a>
            </div>
            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <th>Category name :</th>
                        <td>{{$product_info->rel_to_category->category_name}}</td>
                    </tr>
                    <tr>
                        <th>Subategory name :</th>
                        <td>{{$product_info->rel_to_subcategory->subcategory_name}}</td>
                    </tr>
                    <tr>
                        <th>Brand name :</th>
                        <td>{{$product_info->rel_to_brand->brand_name}}</td>
                    </tr>
                    <tr>
                        <th>Product name :</th>
                        <td>{{$product_info->product_name}}</td>
                    </tr>
                    <tr>
                        <th>Sku :</th>
                        <td>{{$product_info->sku}}</td>
                    </tr>
                    <tr>
                        <th>Discount :</th>
                        <td>{{$product_info->discount}} %</td>
                    </tr>
                    <tr>
                        <th>Short_desp :</th>
                        <td>{{$product_info->short_desp}}</td>
                    </tr>
                    <tr>
                        <th>Long_desp :</th>
                        <td>{!!$product_info->long_desp!!}</td>
                    </tr>
                    <tr>
                        <th>Additional info :</th>
                        <td class="text-wrap">{!!$product_info->aditional!!}</td>
                    </tr>
                    <tr>
                        <th>Tag_name :</th>
                        <td>
                            @php
                                $explode = explode(',',$product_info->tags);
                            @endphp
                            @foreach ($explode as $tag_id)
                                <strong>{{App\Models\Tag::find($tag_id)->tag_name}},</strong>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Preview Image :</th>
                        <td><img src="{{asset('uploads/product/preview/')}}/{{$product_info->preview}}" alt=""></td>
                    </tr>
                    <tr>
                        <th>Gallery Image :</th>
                        <td>
                            @foreach (App\Models\Gallery::where('product_id',$product_info->id)->get() as $gallery)
                            <img src="{{asset('uploads/product/gallery/')}}/{{$gallery->gallery_name}}" alt="">
                        @endforeach
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection