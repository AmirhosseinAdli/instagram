@extends('layouts.pages')
@section('content')
    {{$user->username}}<br>
    @if(DB::table('users')
            ->Join('relations','relations.follower_id','=','users.id')
            ->where('relations.follower_id',auth()->id())
            ->where('relations.followed_id',$user->id)
            ->select('relations.is_accepted AS is_accepted')
            ->get()->first() && DB::table('users')
            ->Join('relations','relations.follower_id','=','users.id')
            ->where('relations.follower_id',auth()->id())
            ->where('relations.followed_id',$user->id)
            ->select('relations.is_accepted AS is_accepted')
            ->get()->first()->is_accepted == 1)
        <form action="{{route('unfollow',$user)}}" method="post">
            @csrf
            <button type="submit">Unfollow</button>
        </form>
    @elseif(DB::table('users')
            ->Join('relations','relations.follower_id','=','users.id')
            ->where('relations.follower_id',auth()->id())
            ->where('relations.followed_id',$user->id)
            ->select('relations.is_accepted AS is_accepted')
            ->get()->first() == null && $user != auth()->user())
        <form action="{{route('follow',$user)}}" method="post">
            @csrf
            <button type="submit">Follow</button>
        </form>
        @elseif( DB::table('users')
            ->Join('relations','relations.follower_id','=','users.id')
            ->where('relations.follower_id',auth()->id())
            ->where('relations.followed_id',$user->id)
            ->select('relations.is_accepted AS is_accepted')
            ->get()->first() && DB::table('users')
            ->Join('relations','relations.follower_id','=','users.id')
            ->where('relations.follower_id',auth()->id())
            ->where('relations.followed_id',$user->id)
            ->select('relations.is_accepted AS is_accepted')
            ->get()->first()->is_accepted == 0)
        <form action="{{route('unfollow',$user)}}" method="post">
            @csrf
            <button type="submit">Requested</button>
        </form>
        @else

    @endif
    @if($user->username == auth()->user()->username
 || $user->is_private == 0
  || DB::table('relations')
    ->where('follower_id',1)
    ->where('followed_id',2)
    ->where('is_accepted',1)->first() != null)
        {{$user->posts()->count()}} posts <a href="{{route('followers',$user)}}">{{$followers}} followers</a>  <a href="{{route('following',$user)}}">{{$following}} following</a>

        <br>
        {{$user->bio}}<br>
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
    @else
        {{$user->posts()->count()}} posts  {{$followers}} followers  {{$following}} following

        <br>
        {{$user->bio}}<br>
        This Account is Private<br/>
        Follow to see their photos and videos.
    @endif
@endsection
