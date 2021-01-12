@extends('layouts.pages')
@section('content')
    <div class="container col-md-6">
    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="file" class="form-control" name="media">
        </div>
        <div class="form-group">
            <label>caption</label>
            <textarea class="form-control" name="caption"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mentions</label>
            <input type="text" class="form-control" name="mention">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection
