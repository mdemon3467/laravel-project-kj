@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>
                    Invetory List
                </h3>
            </div>
                @if (session('delete'))
                <strong class="alert alert-success">{{session('delete')}}</strong>
                @endif
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col">Color</th>
                        <th scope="col">Size</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">After Discount</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{$inventory->rel_to_color->color_name}}</td>
                            <td>{{$inventory->rel_to_size->size}}</td>
                            <td>{{$inventory->quantity}}</td>
                            <td>{{$inventory->price}}</td>
                            <td>{{$inventory->after_discount}}</td>
                            <td>
                                <a href="{{route('inventory.delete',$inventory->id)}}">
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
                   Add inventory
                </h3>
            </div>
            @if (session('success'))
            <strong class="alert alert-success">{{session('success')}}</strong>
            @endif
            <div class="card-body">
                <form action="{{route('inventory.store',$products->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Product Name</label>
                        <input type="text" disabled class="form-control" value="{{$products->product_name}}">
                    </div>
                    <div class="mb-3">
                        <select name="color_id" class="form-control">
                            <option value="">Select color</option>
                            @foreach ($colors as $color)
                                <option value="{{$color->id}}">{{$color->color_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        @error('color_id')
                            <strong class="alert alert-danger">{{$message}}</strong>
                         @enderror
                    </div>
                    <div class="mb-3">
                        <select name="size_id" class="form-control">
                            <option value="">Select Size</option>
                            @foreach ($sizes as $size)
                                <option value="{{$size->id}}">{{$size->size}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        @error('size_id')
                            <strong class="alert alert-danger">{{$message}}</strong>
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Product Quantity</label>
                        <input type="number" name="quantity" class="form-control">
                    </div>
                    <div class="mb-3">
                        @error('quantity')
                            <strong class="alert alert-danger">{{$message}}</strong>
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Product Price</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    <div class="mb-3">
                        @error('price')
                            <strong class="alert alert-danger">{{$message}}</strong>
                         @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Add inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection