@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>tags list</h3>
                </div>
                @if (session('delete'))
                <strong class="alert alert-success">{{session('delete')}}</strong>
                @endif
                <div class="card-body">
                    <table class="table table-info table-striped table-striped-columns">
                        <tr class="table table-success">
                            <th scope="col">#</th>
                            <th scope="col">category name</th>
                            <th scope="col">create at</th>
                            <th scope="col">action</th>
                        </tr>
                        <tbody>
                            @forelse ($tags as $sl=> $tag)
                                <tr>
                                <td>{{$tags->firstitem()+$sl}}</td>
                                <td>{{$tag->tag_name}}</td>
                                <td>{{$tag->created_at->diffForHumans()}}</td>
                                <td>
                                    <a title="selete" href="{{route('tag.delete',$tag->id)}}" class="btn btn-danger btn-icon animation">
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
                <div class="mb-3">
                    {{$tags->links()}}
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h3>
                        Add Tags name
                    </h3>
                </div>
                @if (session('success'))
                    <strong class="alert alert-success">{{session('success')}}</strong>
                @endif
                {{-- @error('tag_name.*')
                    <strong class="alert alert-danger">{{$message}}</strong>
                @enderror --}}
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <strong class="alert alert-danger">{{ $error }}</strong>
                    @endforeach
                @endif
                <div class="card-body">
                    <form action="{{route('tag.store')}}" method="POST">
                        @csrf
                        <label for="" class="label-control">Tag name</label>

                        <div class="mb-3" id="input-cont">
                            <input type="text" class="form-control" name="tag_name[]">
                        </div>
                        <div class="mb-2 text-right">
                            <button class="btn btn-success" type="button" onclick='addInput()'>add inputs</button>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">add tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
<script>

const container = document.getElementById('input-cont');
// Call addInput() function on button click
function addInput(){
    let input = document.createElement('input');
    input.placeholder = 'Tag name';
    input.name = 'tag_name[]';
    input.classList.add('form-control');
    input.classList.add('mt-3');
    input.setAttribute("type", "text");
    container.appendChild(input);
}
</script>
@endsection