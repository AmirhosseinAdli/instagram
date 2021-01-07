<?php

namespace App\Http\Controllers;

use App\Models\Relation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelationController extends Controller
{
    public function followers(User $user)
    {
        $followers = DB::table('users')
            ->Join('relations','relations.follower_id','=','users.id')
            ->where('relations.followed_id',$user->id)
            ->where('relations.is_accepted',1)
            ->select('users.username AS username')
            ->get();
        return view('followers',compact('followers'));
    }

    public function following(User $user)
    {
        $followings = DB::table('users')
            ->Join('relations','relations.followed_id','=','users.id')
            ->where('relations.follower_id',$user->id)
            ->where('relations.is_accepted',1)
            ->select('users.username AS username')
            ->get();
        return view('following',compact('followings'));
    }

    public function follow(User $user)
    {
        if ($user->is_private == 0){
            Relation::create([
                'follower_id' => auth()->id(),
                'followed_id' => $user->id,
                'is_accepted' => 1,
            ]);
        }
        else{
            Relation::create([
                'follower_id' => auth()->id(),
                'followed_id' => $user->id,
                'is_accepted' => 0,
            ]);
        }
        return redirect()->back();
    }

    public function unfollow(User $user)
    {
        Relation::where('follower_id',auth()->id())->where('followed_id',$user->id)->delete();
        return redirect()->back();
    }
}
