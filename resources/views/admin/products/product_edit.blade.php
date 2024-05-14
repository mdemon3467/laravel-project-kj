@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>edit Products</h3>
            </div>
            @if (session('success'))
            <strong class="alert alert-success">{{session('success')}}</strong>
            @endif
            <div class="card-body">
                <form action="{{route('product.update',$products->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="" >Select Category</label>
                            <select name="category_id" class="form-control" id="category_id">

                                <option value="">Enter Category</option>
                                @foreach ($categoryies as $category)
                                    <option {{$products->category_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach

                            </select>
                            <div class="mt-2">
                                @error('category_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="" >Select subCategory</label>
                            <select name="subcategory_id" class="form-control" id="subcategory">
                                <option value="">Enter Subcategory</option>
                                @foreach ($subcategoryies as $subcategory)
                                    <option {{$products->subcategory_id == $subcategory->id ? 'selected' : ''}} value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
                                @endforeach
                            </select>
                            <div class="mt-2">
                                @error('subcategory_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="" >Select brand</label>
                            <select name="brand_id" class="form-control">
                                <option value="">Inter Brands</option>
                                @foreach ($brands as $brand)
                                    <option {{$products->brand == $brand->name ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                            <div class="mt-2">
                                @error('brand_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <label for="">Product name</label>
                                <input type="text" name="product_name" class="form-control" value="{{$products->product_name}}">
                            </div>
                            <div class="mt-2">
                                @error('product_name')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <label for="">Product Code (SKU)</label>
                                <input type="text" name="sku" class="form-control" value="{{$products->sku}}">
                            </div>
                            <div class="mt-2">
                                @error('sku')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mt-3">
                                <label for="">Discount %</label>
                                <input type="number" name="discount" class="form-control" value="{{$products->discount}}">
                            </div>
                            <div class="mt-2">
                                @error('discount')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mt-3">
                                <label for="">Short Discription</label>
                                <input type="text" name="short_desp" class="form-control" value="{{$products->short_desp}}">
                            </div>
                            <div class="mt-2">
                                @error('short_desp')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-3">
                                <label for="">Long Discription</label>
                                <textarea class="form-control" name="long_desp" id="summernote1" cols="100" rows="4">{!!$products->long_desp!!}</textarea>
                            </div>
                            <div class="mt-2">
                                @error('long_desp')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-3">
                                <label for="">Aditional Information</label>
                                <textarea class="form-control" name="aditional" id="summernote" cols="100" rows="4">{!!$products->aditional!!}</textarea>
                            </div>
                            <div class="mt-2">
                                @error('aditional')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-3">
                                <label for="">Tags</label>
                                {{-- <select id="select-gear" class="demo-default" multiple placeholder="Select tags..." name="tag_id[]">
                                    <option value="">Select tags...</option>
                                    <optgroup label="Climbing">
                                        @foreach ($tags as $tag)
                                        <option {{ $products->tags == $tag->id ? 'selected' : '' }} value="{{$tag->id}}">{{$tag->tag_name}}</option>
                                        @endforeach
                                    </optgroup>
                                  </select> --}}

                                  <select id="select-gear" class="demo-default" multiple placeholder="Select tags..." name="tag_id[]">
                                    <option value="">Select tags...</option>
                                    <optgroup label="Climbing">
                                        @foreach ($tags as $tag)
                                            <option {{ $products->tags->contains($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                

                                  <div class="mt-2">
                                    @if ($errors->any())
                                        <strong class="text-danger">Plz inter some tag</strong>
                                    @endif
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <label for="">Preview Images</label>
                                <input type="file" name="preview" class="form-control">
                            </div>
                            <div class="mt-2">
                                @error('preview')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <label for="">Gallary Images</label>
                                <input type="file" name="gallery[]" class="form-control" multiple>
                            </div>
                            <div class="mt-2">
                                @if ($errors->any())
                                    <strong class="text-danger">Plz inter gallery image</strong>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 m-auto">
                            <div class="mt-5">
                                <button type="submit" class="btn btn-primary form-control">Add Aroduct</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    //for edit dicription
 $('#summernote').summernote();
 $('#summernote1').summernote();
 $('#select-gear').selectize({ sortField: 'text' })
</script>
<script>
    // for category to subcategory option
    $('#category_id').change(function(){
        var category_id = $(this).val();

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
            type:'POST',
            url:'/getsubcategory',
            data:{'category_id' : category_id},
            success:function(data){
                $('#subcategory').html(data);
            }
        });

        })
</script>
@endsection

