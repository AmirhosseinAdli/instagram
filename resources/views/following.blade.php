@extends('layouts.pages')
@section('content')
    Following<br>
    @forelse($followings as $key => $following)
        <a href="{{route('profile',$following->username)}}">{{$following->username}}</a>
    @empty
        No following
    @endforelse
@endsection
