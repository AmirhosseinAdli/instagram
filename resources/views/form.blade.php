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
