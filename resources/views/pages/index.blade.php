@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="bg-primary p-5 text-center w-100">Index page</h1>
        @foreach($posts as $post)
            <div class="col-md-4 mb-4"> <!-- تنظيم البطاقات في أعمدة -->
                <div class="card" style="width: 18rem;">
                   
                    <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" alt="Card image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->name }}</h5>
                        <p class="card-text">{{Str::limit($post->content,90) }}</p>
                        <a href="{{route('edit.post',$post['id'])}}" class="btn btn-primary" style="background-color: green; border-color: green;">Edit</a>
                        <a href="{{url('/delete/'.$post->id)}}" class="btn btn-primary" style="background-color: red; border-color: red;">Delete</a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>


</div>

@endsection
