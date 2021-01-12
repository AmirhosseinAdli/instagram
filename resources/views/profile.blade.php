@extends('layouts.pages')
@section('content')
    <div class="d-flex flex-row mt-4 border-bottom">
        <div class="col-md-4">
            <a href="#"><img class="rounded-circle" style="width: 90px;height: 90px" src="{{$user->profilePicture?->url}}"></a>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-row">
                <div class="pr-5">
                    {{$user->username}}<br>
                </div>
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
                        <button type="submit" class="btn btn-primary">Unfollow</button>
                    </form>
                @elseif(DB::table('users')
                        ->Join('relations','relations.follower_id','=','users.id')
                        ->where('relations.follower_id',auth()->id())
                        ->where('relations.followed_id',$user->id)
                        ->select('relations.is_accepted AS is_accepted')
                        ->get()->first() == null && $user->username != auth()->user()->username)
                    <form action="{{route('follow',$user)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Follow</button>
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
                        <button type="submit" class="btn btn-default"
                                style="border: 1px solid rgba(var(--ca6,219,219,219),1);">Requested
                        </button>
                    </form>
                @else

                @endif
            </div>
            <div>
                @if($user->username == auth()->user()->username
             || $user->is_private == 0
              || DB::table('relations')
                ->where('follower_id',1)
                ->where('followed_id',2)
                ->where('is_accepted',1)->first() != null)
                    <div class="d-flex flex-row">
                    <div class="d-flex flex-row">
                        <div class="mr-2">
                            {{$user->posts()->count()}} posts
                        </div>
                        <div class="mx-2">
                            <a href="{{route('followers',$user)}}">{{$followers}} followers</a>
                        </div>
                        <div class="mx-2">
                            <a href="{{route('following',$user)}}">{{$following}} following</a>
                        </div>
                    </div>
                <div>
                    <form action="{{route('settings')}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-default"
                                style="border: 1px solid rgba(var(--ca6,219,219,219),1);">Edit Profile
                        </button>
                    </form>
                </div>
                    </div>

                    <br>
                    {{$user->bio}}<br>
            </div>
            @else
                <div class="d-flex flex-row">
                    <div class="mr-2">
                        {{$user->posts()->count()}} posts
                    </div>
                    <div class="mx-2">
                        {{$followers}} followers
                    </div>
                    <div class="mx-2">
                        {{$following}} following
                    </div>
                </div><br>
                {{$user->bio}}
            @endif
        </div>
    </div>
    <div class="card-columns">
        @if($user->is_private == 1 && (DB::table('users')
        ->Join('relations','relations.follower_id','=','users.id')
        ->where('relations.follower_id',auth()->id())
        ->where('relations.followed_id',$user->id)
        ->select('relations.is_accepted AS is_accepted')
        ->get()->first() == null || DB::table('users')
        ->Join('relations','relations.follower_id','=','users.id')
        ->where('relations.follower_id',auth()->id())
        ->where('relations.followed_id',$user->id)
        ->select('relations.is_accepted AS is_accepted')
        ->get()->first()->is_accepted == 0) && $user->username != auth()->user()->username)
            This Account is Private<br/>
            Follow to see their photos and videos.
        @else
            @forelse($user->posts as $post)
                <a href="{{route('posts.show',$post)}}">
                    <div class="card m-3">
                        <img class="card-img-top" src="{{$post->medias()->first()?->url}}">
                    </div>
                </a>
            @empty
                No Posts Yet
            @endforelse
        @endif
    </div>
@endsection
