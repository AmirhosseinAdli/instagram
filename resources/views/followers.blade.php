@extends('layouts.pages')
@section('content')
    Followers<br>
    @forelse($followers as $key => $follower)
        <a href="{{route('profile',$follower->username)}}">{{$follower->username}}</a>
    @empty
        No followers
    @endforelse
@endsection
