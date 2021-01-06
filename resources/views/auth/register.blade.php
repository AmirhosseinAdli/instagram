@extends('layouts.auth')
@section('content')
    <div class="container col-md-3 justify-content-center d-flex flex-column text-center align-items-center h-100">
        @if($errors->any())
            <div class="errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="shadow-sm bg-white border border-light rounded text-center px-5 w-100">
            <div class="text-center p-2 pb-4">
                <img src="{{asset('img/instagram-new-logo.png')}}" style="width: 200px">
            </div>
            <p class="font-weight-light">Sign up to see photos and videos from your friends.</p>
            @component('components.auth',[
        'route' => route('auth.sendCode'),
        'method' => 'post',
        'inputs' => [
            0 => [
                'type' => 'text',
                'name' => 'moe',
                'placeholder' => 'Mobile Number or Email',
    ],
            1 => [
                'type' => 'text',
                'name' => 'full_name',
                'placeholder' => 'Full Name',
    ],
            2 => [
                'type' => 'text',
                'name' => 'username',
                'placeholder' => 'Username',
    ],
            3 => [
                'type' => 'password',
                'name' => 'password',
                'placeholder' => 'Password',
    ],
    ],
    'button' => 'Sign up'
    ])
            @endcomponent
        </div>
        <div class="shadow-sm bg-white border border-light rounded text-center mt-2 w-100">
            Have an account? <a href="{{route('auth.login')}}">Log in</a>
        </div>
    </div>
@endsection
