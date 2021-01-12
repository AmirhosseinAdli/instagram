<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\build_query;
use function PHPUnit\Framework\objectEquals;

class MainController extends Controller
{
    public function main()
    {
        $followed_ids = DB::table('users')
            ->Join('relations','relations.follower_id','=','users.id')
            ->where('relations.follower_id','=',auth()->id())
            ->where('relations.is_accepted','=',1)
            ->select('relations.followed_id AS followed_id')
            ->get();
        $ids = [];
        foreach ($followed_ids as $followed_id)
        {
            $ids[] = $followed_id->followed_id;
        }
        $posts[0] = Post::query()->where('user_id',$ids[0]);
        for ($i = 1; $i < count($ids); $i++){
            $posts[$i] = $posts[$i-1]->orWhere('user_id',$ids[$i]);
        }
        $posts = $posts[count($ids)-1]->latest()->get();
        return view('main',compact('posts'));
    }
}
