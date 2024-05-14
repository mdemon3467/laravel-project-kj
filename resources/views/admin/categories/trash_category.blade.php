@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-lg-12 m-auto">
        <form action="{{route('category.check.restore')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Trash Category List</h3>
                    <span>
                        <button type="submit" class="btn btn-danger d-none " id="del_btn" name="btn" value="restore" style="line-height: 20px">Restore All</button>
                        <button type="submit" class="btn btn-danger d-none " id="del_btn" name="btn" value="forcedelete" style="line-height: 20px">parmanent delete</button>
                    </span>
                </div>
                @if (session('restore'))
                    <strong class="alert alert-success">{{session('restore')}}</strong>
                @endif

                @if (session('parmanet'))
                <strong class="alert alert-success">{{session('parmanet')}}</strong>
                @endif

                <div class="card-body">
                    <table class="table table-striped ">
                        {{-- <thead> --}}
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
                                <th scope="col" class="">#</th>
                                <th scope="col">category name</th>
                                <th scope="col">category photo</th>
                                <th scope="col">slug</th>
                                <th scope="col">create at</th>
                                <th scope="col">action</th>
                            </tr>
                        {{-- </thead> --}}
                        <tbody>
                            @forelse ($categories as $sl=> $category)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input checkDel" name="category_id[]" value="{{$category->id}}">
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
                                    <a title="restore" data-link="{{route('category.restore',$category->id)}}" class="btn btn-primary btn-icon animation1">
                                        <i data-feather="refresh-ccw"></i>
                                    </a>
                                    <a title="parmanet delete" data-link="{{route('category.parmanent.delete',$category->id)}}" class="btn btn-danger btn-icon animation2">
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
</div>

@endsection
@section('footer_script')
{{-- checek all --}}
    <script>
        $('#cheackAll').on('click',function(){
            $("button").toggleClass("d-none");
            this.checked ? $(".checkDel").prop("checked",true) : $(".checkDel").prop("checked",false);
        })
    </script>

    {{-- restore animation --}}
        <script>
            $('.animation1').click(function(){
                Swal.fire({
                title: "Are you sure?",
                text: "You would be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, restore it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    var link = $(this).attr('data-link');
                    window.location.href = link;
                }
                });
            })
        </script>
        @if(session('restore'))
            <script>
                Swal.fire({
                title: "Restore!",
                text: "Your file has been restore.",
                icon: "success"
        });
            </script>
        @endif

            {{-- delete animation --}}
            <script>
                $('.animation2').click(function(){
                    Swal.fire({
                    title: "Are you sure?",
                    text: "You would be able to revert this!",
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
            @if(session('parmanet'))
                <script>
                    Swal.fire({
                    title: "Delete!",
                    text: "Your file has been parmanenet delete.",
                    icon: "success"
            });
                </script>
            @endif
@endsection

