@extends('layouts.pages')
@section('content')

        <div class="card-columns">
            @forelse($user->posts as $post)
                <a href="{{route('posts.show',$post)}}">
                    <div class="card m-3">
                        <img class="card-img-top" src="{{$post->medias()->first()?->url}}">
                    </div>
                </a>
            @empty
                No Posts Yet
            @endforelse
        </div>
@endsection
