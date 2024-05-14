@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Add New Products</h3>
                <a class="btn btn-primary mt-2" href="{{route('product.list')}}">Product List</a>
            </div>
            @if (session('success'))
            <strong class="alert alert-success">{{session('success')}}</strong>
            @endif
            <div class="card-body">
                <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="" >Select Category</label>
                            <select name="category_id" class="form-control" id="category_id">
                                <option value="">Select category name</option>
                                @foreach ($categoryies as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            <div class="mt-2">
                                @error('category_id')
                                    <strong class="alert alert-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="" >Select subCategory</label>
                            <select name="subcategory_id" class="form-control" id="subcategory">
                                <option value="">Select subcategory name</option>
                                @foreach ($subcategoryies as $subcategory)
                                    <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
                                @endforeach
                            </select>
                            <div class="mt-2">
                                @error('subcategory_id')
                                    <strong class="alert alert-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="" >Select brand</label>
                            <select name="brand_id" class="form-control">
                                <option value="">Select brand name</option>
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                            <div class="mt-2">
                                @error('brand_id')
                                    <strong class="alert alert-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <label for="">Product name</label>
                                <input type="text" name="product_name" class="form-control">
                            </div>
                            <div class="mt-2">
                                @error('product_name')
                                    <strong class="alert alert-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <label for="">Product Code (SKU)</label>
                                <input type="text" name="sku" class="form-control">
                            </div>
                            <div class="mt-2">
                                @error('sku')
                                    <strong class="alert alert-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mt-3">
                                <label for="">Discount %</label>
                                <input type="number" name="discount" class="form-control">
                            </div>
                            <div class="mt-2">
                                @error('discount')
                                    <strong class="alert alert-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mt-3">
                                <label for="">Short Discription</label>
                                <input type="text" name="short_desp" class="form-control">
                            </div>
                            <div class="mt-2">
                                @error('short_desp')
                                    <strong class="alert alert-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-3">
                                <label for="">Long Discription</label>
                                <textarea class="form-control" name="long_desp" id="summernote1" cols="100" rows="4">Product Discription</textarea>
                            </div>
                            <div class="mt-2">
                                @error('long_desp')
                                    <strong class="alert alert-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-3">
                                <label for="">Aditional Information</label>
                                <textarea class="form-control" name="aditional" id="summernote" cols="100" rows="4">Aditional Information</textarea>
                            </div>
                            <div class="mt-2">
                                @error('aditional')
                                    <strong class="alert alert-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-3">
                                <label for="">Tags</label>
                                <select id="select-gear" class="demo-default" multiple placeholder="Select tags..." name="tag_id[]">
                                    <option value="">Select tags...</option>
                                    <optgroup label="Climbing">
                                        @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                                        @endforeach
                                    </optgroup>
                                  </select>
                                  <div class="mt-2">
                                    @if ($errors->any())
                                        <strong class="alert alert-danger">Plz inter some tag</strong>
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
                                    <strong class="alert alert-danger">{{$message}}</strong>
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
                                    <strong class="alert alert-danger">Plz inter gallery image</strong>
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

