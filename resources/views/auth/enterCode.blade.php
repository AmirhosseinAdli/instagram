<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    <form action="{{route('auth.register')}}" method="post">
        @csrf
        <input type="hidden" name="moe" value="{{$request->moe}}">
        <input type="hidden" name="full_name" value="{{$request->full_name}}">
        <input type="hidden" name="username" value="{{$request->username}}">
        <input type="hidden" name="password" value="{{$request->password}}">
        Enter your code: <input type="text" name="code">
        <button type="submit">enter</button>
    </form>
</div>
</body>
</html>
