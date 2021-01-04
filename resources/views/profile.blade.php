profile of {{$user->username}}<br><br>
<ul>
@forelse($user->posts as $post)
    <li>
        <img src="{{$post->medias[0]->url}}">
    </li>
@empty
    No Posts
@endforelse
</ul>
