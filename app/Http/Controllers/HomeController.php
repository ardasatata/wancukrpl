<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Posting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function homeFeed(){


        //$posting = Posting::all();


        $posting = DB::table('posting')->join('userFollowing','posting.user_id','=','userFollowing.followed_id')
            ->where('userFollowing.user_id','=',Auth::id())
            ->orWhere('posting.user_id','=',Auth::id())
            ->orderby('created_at','desc')
            ->paginate(10);


        //dd($posting);


        return view('home',['posting'=>$posting]);
    }
}
