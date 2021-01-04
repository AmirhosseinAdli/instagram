<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<div class="card" style="width: 18rem;">
    @foreach($post->medias as $media)
    <img class="card-img-top" src="{{$media->url}}" alt="Card image cap">
    @endforeach
    <div class="card-body">
        <p class="card-text">
            @php
                $re1 = '/\S*@(\[[^\]]+\]|\S+)/m';
                $re2 = '/\S*#(\[[^\]]+\]|\S+)/m';
$str = $post->caption;
$subst1 = '<a href="' . env('APP_URL') .'/$1">@$1</a>';
$subst2 = '<a href="' . env('APP_URL') .'/$1">#$1</a>';
$result = preg_replace($re1, $subst1, $str);
$result = preg_replace($re2, $subst2, $result);
echo $result;
            @endphp
        </p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
