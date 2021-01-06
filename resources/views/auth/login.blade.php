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
        <div class="d-flex flex-row">
            <div>
                <img src="{{asset('img/phone.jpg')}}" class="rounded" style="width: 300px;height: 300px">
            </div>
        <div class=" shadow-sm bg-white border border-light rounded text-center px-5 w-100">
            <div class="text-center p-2 pb-4">
                <img src="{{asset('img/instagram-new-logo.png')}}" style="width: 200px">
            </div>
            @component('components.auth',[
        'route' => route('auth.login'),
        'method' => 'post',
        'inputs' => [
            0 => [
                'type' => 'text',
                'name' => 'meu',
                'placeholder' => 'Phone number, username or email',
    ],
            1 => [
                'type' => 'password',
                'name' => 'password',
                'placeholder' => 'password',
    ]
    ],
    'button' => 'Log in'
    ])
            @endcomponent
            <div class="text-center pb-3 mt-2">
                <a href="#">Forgot password?</a>
            </div>
        </div>
        </div>
        <div class=" shadow-sm bg-white border border-light rounded text-center px-5 mt-2 w-100">
            Don't have an account? <a href="{{route('auth.register')}}">Sign up</a>
        </div>
    </div>
@endsection
