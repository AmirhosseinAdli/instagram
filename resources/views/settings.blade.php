@extends('layouts.pages')
@section('content')
    @if($errors->any())
        <div class="errors">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('update',auth()->user())}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4" value="{{auth()->user()->email ?? ''}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Mobile Phone</label>
                <input type="text" name="mobile" class="form-control" value="{{auth()->user()->mobile ?? ''}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Name</label>
                <input type="text" name="full_name" class="form-control" value="{{auth()->user()->full_name}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Username</label>
                <input type="text" name="username" class="form-control" value="{{auth()->user()->username}}">
            </div>
            <div class="form-group col-md-12">
                <label for="inputEmail4">Bio</label>
                <textarea type="text" name="bio" class="form-control">{{auth()->user()->bio}}</textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Website</label>
                <input type="text" name="website" class="form-control" value="{{auth()->user()->website}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword4">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Profile Picture</label>
                <input type="file" name="picture" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-3">
                <label for="inputState">Gender</label>
                <select id="inputState" class="form-control" name="gender">
                    <option value="male" @if(auth()->user()->gender == 'male') selected @endif>Male</option>
                    <option value="female" @if(auth()->user()->gender == 'female') selected @endif>Female</option>
                    <option value="" @if(auth()->user()->gender == null) selected @endif>...</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputState">Privacy</label>
                <select id="inputState" class="form-control" name="is_private">
                    <option value="0" @if(auth()->user()->is_private == 0) selected @endif>Public</option>
                    <option value="1" @if(auth()->user()->is_private == 1) selected @endif>Private</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
