<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Hello, world!</title>
    <style>
        body {
            background: #eee
        }

        .date {
            font-size: 11px
        }

        .comment-text {
            font-size: 12px
        }

        .fs-12 {
            font-size: 12px
        }

        .shadow-none {
            box-shadow: none
        }

        .name {
            color: #007bff
        }

        .cursor:hover {
            color: blue
        }

        .cursor {
            cursor: pointer
        }

        .textarea {
            resize: none
        }
    </style>
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
$subst1 = "<a href='" . env('APP_URL') . '/$1' . "' style='text-decoration: none'>@$1</a>";
$subst2 = '<a href="' . env('APP_URL') .'/$1" style="text-decoration: none">#$1</a>';
$result = preg_replace($re1, $subst1, $str);
$result = preg_replace($re2, $subst2, $result);
echo $result;
            @endphp
        </p>
    </div>
</div>
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="d-flex flex-column comment-section">
                @forelse($post->comments as $key => $comment)
                    @if($comment->p_id==null)
                <div class="bg-white p-2">
                    <div class="d-flex flex-row user-info"><img class="rounded-circle" src="" width="40">
                        <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">{{$comment->user->username}}</span><span class="date text-black-50">Shared publicly - {{$comment->created_at}}</span></div>
                    </div>
                    <div class="mt-2">
                        <p class="comment-text">{{$comment->content}}</p>
                    </div>
                </div>
                <div class="bg-white">
                    <div class="d-flex flex-row fs-12">
                        <div class="like p-2 cursor"><i class="fa fa-thumbs-o-up"></i><span class="ml-1">Like</span></div>
                        <form action="{{route('comments.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="p_id" value="{{$comment->id}}">
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div class="like p-2 cursor" id="reply{{$key}}" onclick="reply{{$key}}()"><i class="fa fa-reply"></i><span class="ml-1">Reply</span></div>
                        </form>
                        <div class="like p-2 cursor"><i class="fa fa-share"></i><span class="ml-1">Share</span></div>
                    </div>
                </div>
                    @while($comment->commnets)
                        @foreach($comment->comments as $key2 => $sub_comment)
                            <div>
                            <div class="bg-white p-2">
                                <div class="d-flex flex-row user-info"><img class="rounded-circle" src="" width="40">
                                    <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">{{$sub_comment->user->username}}</span><span class="date text-black-50">Shared publicly - {{$comment->created_at}}</span></div>
                                </div>
                                <div class="mt-2">
                                    <p class="comment-text">{{$sub_comment->content}}</p>
                                </div>
                            </div>
                            <div class="bg-white">
                                <div class="d-flex flex-row fs-12">
                                    <div class="like p-2 cursor"><i class="fa fa-thumbs-o-up"></i><span class="ml-1">Like</span></div>
                                    <form action="{{route('comments.store')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="p_id" value="{{$sub_comment->id}}">
                                        <input type="hidden" name="post_id" value="{{$post->id}}">
                                        <div class="like p-2 cursor" id="reply{{$key2}}" onclick="reply{{$key2}}()"><i class="fa fa-reply"></i><span class="ml-1">Reply</span></div>
                                    </form>
                                    <div class="like p-2 cursor"><i class="fa fa-share"></i><span class="ml-1">Share</span></div>
                                </div>
                            </div>
                        @endforeach

                                @endwhile

                    @endif
                @empty
                    No Comments yet
                @endforelse
                    <form action="{{route('comments.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="p_id" value="{{null}}">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="bg-light p-2">
                            <div class="d-flex flex-row align-items-start">
                                <img class="rounded-circle" src="" width="40">
                        <textarea class="form-control ml-1 shadow-none textarea" name="content"></textarea>
                    </div>
                    <div class="mt-2 text-right">
                        <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                    </div>
                </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<script>
    @forelse($post->comments as $key => $comment)
    function reply{{$key}}() {
        document.getElementById("reply{{$key}}").innerHTML="<div class='bg-light p-2'> <div class='d-flex flex-row align-items-start'> <img class='rounded-circle' src='' width='40'> <textarea class='form-control ml-1 shadow-none textarea' name='content'></textarea> </div> <div class='mt-2 text-right'> <button class='btn btn-primary btn-sm shadow-none' type='submit'>Post comment</button><button class='btn btn-outline-primary btn-sm ml-1 shadow-none' type='button'>Cancel</button> </div> </div>";
        document.getElementById("reply{{$key}}").removeAttribute("id","reply{{$key}}");
    }
    @empty
        @endforelse
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>
</html>
