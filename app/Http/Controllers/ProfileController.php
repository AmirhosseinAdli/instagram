<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile(User $user)
    {
        $followers = DB::table('relations')
            ->Join('users','users.id','=','relations.followed_id')
            ->where('relations.followed_id',$user->id)
            ->where('relations.is_accepted',1)
            ->select(DB::raw('COUNT(relations.id) AS followers'))
            ->get()->first()->followers;
        $following = DB::table('relations')
            ->Join('users','users.id','=','relations.follower_id')
            ->where('relations.follower_id',$user->id)
            ->where('relations.is_accepted',1)
            ->select(DB::raw('COUNT(relations.id) AS following'))
            ->get()->first()->following;
        return view('profile')
            ->withUser($user)
            ->withFollowers($followers)
            ->withFollowing($following);
    }
}
