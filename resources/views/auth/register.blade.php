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
    <form action="{{route('auth.sendCode')}}" method="post">
        @csrf
        mobile number or email: <input type="text" name="moe"><br><br>
        full name: <input type="text" name="full_name"><br><br>
        username: <input type="text" name="username"><br><br>
        password: <input type="password" name="password"><br><br>
        birthdate: <input type="date" name="birthdate"><br><br>
        <button type="submit">Next</button>
    </form>
</div>
</body>
</html>
