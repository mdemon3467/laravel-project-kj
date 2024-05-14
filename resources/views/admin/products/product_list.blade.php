@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Product List</h3>
                <a class="btn btn-primary mt-2" href="{{route('product')}}">Add New Product</a>
            </div>
            @if (session('success'))
                <strong class="alert alert-success">{{session('success')}}</strong>
            @endif
            <div class="card-body">
                <table class="table table-striped table-responsive">
                    <tr>
                        <th>Sku</th>
                        <th>Product</th>
                        <th>Discount</th>
                        <th>Tags</th>
                        <th>Preview</th>
                        <th>ThumbNail</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr >
                            <td>{{$product->sku}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->discount}} %</td>
                            <td>

                                @php
                                    $explode = explode(',',$product->tags);
                                @endphp
                                @foreach($explode as $tag_id)
                                        <strong class="btn btn-primary">{{App\Models\Tag::find($tag_id)->tag_name}}</strong>
                                @endforeach
                                
                                {{-- //2nd solution --}}
                                {{-- @php
                                $explode = explode(',',$product->tags);
                                foreach ($explode as $tag_id) {
                                    echo(App\Models\Tag::find($tag_id)->tag_name).',';
                                }
                                @endphp --}}

                            </td>
                            <td>
                                <img src="{{asset('uploads/product/preview/')}}/{{$product->preview}}" alt="">
                            </td>
                            <td>
                                @foreach (App\Models\Gallery::where('product_id',$product->id)->get() as $gallery)
                                    <img src="{{asset('uploads/product/gallery/')}}/{{$gallery->gallery_name}}" alt="">
                                @endforeach
                            </td>
                            <td>
                                <a title="inventory" href="{{route('add.inventory',$product->id)}}" class="btn btn-secondary btn-icon ">
                                    <i data-feather="server"></i>
                                </a>
                                <a title="Show" href="{{route('product.view',$product->id)}}" class="btn btn-success btn-icon ">
                                    <i data-feather="eye"></i>
                                </a>
                                <a title="edit" href="{{route('product.edit',$product->id)}}" class="btn btn-primary btn-icon">
                                    <i data-feather="edit"></i>
                                </a>
                                <a title="soft selete" href="{{route('product.delete',$product->id)}}" class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection