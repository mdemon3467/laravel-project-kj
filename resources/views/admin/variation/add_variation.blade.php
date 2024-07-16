@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Color List</h3>
            </div>
            @if (session('delete'))
                <strong class="alert alert-success">{{session('delete')}}</strong>
            @endif
            <div class="card-body">
                <table class="table table-bordared">
                    <tr>
                        <th>Color Name</th>
                        <th>Color Code</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($colors as $color)
                        <tr>
                            <td>{{$color->color_name}}</td>
                            <td>
                                @if ($color->color_name == 'NA')
                                    <strong class="alert">NA</strong>
                                @else
                                    <span class="badge py-3 px-3" style="background:{{$color->color_code}}; color:transparent">Color</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('color.delete',$color->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h3>Size List</h3>
            </div>
            @if (session('delete2'))
                <strong class="alert alert-success">{{session('delete2')}}</strong>
            @endif
            <div class="card-body">
                <table class="table table-bordared">
                    <tr>
                        <th>Size</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($sizes as $size)
                        <tr>
                            <td>{{$size->size}}</td>
                            <td>
                                <a href="{{route('size.delete',$size->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>
                    add color
                </h3>
            </div>
            @if (session('success'))
                <strong class="alert alert-success">{{session('success')}}</strong>
            @endif
            <div class="card-body">
                <form action="{{route('add.color')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="">Color Name</label>
                        <input type="text" name="color_name" class="form-control">
                        <div class="mb-3">
                            @error('color_name')
                            <strong class="btn btn-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Color Code</label>
                        <input type="color" name="color_code" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add color</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h3>
                    Add Size
                </h3>
            </div>
            @if (session('success2'))
                <strong class="alert alert-success">{{session('success2')}}</strong>
            @endif
            <div class="card-body">
                <form action="{{route('add.size')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="">Size</label>
                        <input type="text" name="size" class="form-control">
                        <div class="mb-3">
                            @error('size')
                            <strong class="btn btn-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add size</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
@endsection