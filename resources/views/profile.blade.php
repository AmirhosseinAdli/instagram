profile of {{$user->username}}<br><br>
<ul>
@forelse($user->posts as $post)
    <li>
        @foreach($post->medias as $media)
            <a href="{{route('posts.show',$post)}}"><img src="{{$media->url}}"></a>
        @endforeach
    </li>
@empty
    No Posts
@endforelse
</ul>
