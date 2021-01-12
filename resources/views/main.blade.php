@extends('layouts.pages')
@section('content')
    <div class="container">
        @forelse($posts as $post)
            <div class="card" style="width: 75rem;">
                <a href="{{route('posts.show',$post)}}"><img class="card-img-top" src="{{$post->medias()->first()->url}}" alt="Card image cap"></a>
                <div class="card-body">
                    <h5 class="card-title">{{$post->user->username}}</h5>
                    <p class="card-text">{{$post->caption}}</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @empty
        @endforelse
    </div>
@endsection
