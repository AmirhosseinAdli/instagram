<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function explore()
    {
        $posts = Post::latest()->paginate(20);
        return view('explore')->withPosts($posts);
    }
}
