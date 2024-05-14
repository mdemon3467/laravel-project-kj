@extends('layouts.admin')
@section('content')

<div class="col-lg-12">
    <form action="{{route('category.check.delete')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Category List</h3>
                <button type="submit" class="btn btn-danger d-none " id="del_btn" style="line-height: 20px">Delete All</button>
            </div>
            @if (session('delete'))
                <strong class="alert alert-success">{{session('delete')}}</strong>
            @endif
            <div class="card-body">
                <table class="table table-info table-striped table-striped-columns">
                    <tr class="table table-success">
                        <th>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" id="cheackAll">
                                        Chack All
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">category name</th>
                        <th scope="col">category photo</th>
                        <th scope="col">slug</th>
                        <th scope="col">create at</th>
                        <th scope="col">action</th>
                    </tr>
                    <tbody>
                        @forelse ($categorys as $sl=> $category)
                            <tr>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input checkDel" name="category_id[]" value="{{$category->id}}" id="check">
                                        <i class="input-frame"></i>
                                    </label>
                                </div>
                            </td>
                            <td>{{$sl+1}}</td>
                            <td>{{$category->category_name}}</td>
                            <td><img src="{{asset('uploads/category')}}/{{$category->category_photo}}"/></td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->created_at->diffForHumans()}}</td>
                            <td>
                                <a title="edit" data-link="{{route('category.edit',$category->id)}}" class="btn btn-primary btn-icon animation1">
                                    <i data-feather="edit"></i>
                                </a>
                                <a title="soft selete" data-link="{{route('category.delete',$category->id)}}" class="btn btn-danger btn-icon animation2">
                                    <i data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>
                        @empty 
                        <tr>
                            <td colspan="7" class="text-center">NO data found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
@endsection
@section('footer_script')

    {{-- check all animation --}}
    <script>
        $('#cheackAll').on('click',function(){
            $("button").toggleClass("d-none");
            this.checked ? $(".checkDel").prop("checked",true) : $(".checkDel").prop("checked",false);
        })
    </script>

    {{-- delete data animation --}}
    <script>
        $('.animation2').click(function(){
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                var link = $(this).attr('data-link');
                window.location.href = link;
            }
            });
        })
    </script>

    @if(session('delete'))
    <script>
        Swal.fire({
        title: "Deleted!",
        text: "Your file has been deleted.",
        icon: "success"
    });
    </script>
    @endif

    {{-- edit animation --}}
    <script>
            $('.animation1').click(function(){
                Swal.fire({
                title: "Are you sure?",
                text: "It will modifiy the current data!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Edit it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    var link = $(this).attr('data-link');
                    window.location.href = link;
                }
                });
            })
        </script>
@endsection