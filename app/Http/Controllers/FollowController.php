<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow($user_id)
    {
        $id = Auth::id();

        $follow = new Follow;

        $follow->user_id = $id;

        $follow->followed_id = $user_id;

        $follow->save();

        return redirect()->back();
    }

    public function unfollow($user_id){

        $id = Auth::id();

        $follow = Follow::where('user_id',$id)->where('followed_id',$user_id);

        $follow->delete();

        return back();

    }
}
