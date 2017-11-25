<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function myProfile()
    {
        $id = Auth::id();

        $profile = Profile::findOrFail($id);

        $user = Auth::user();

        return view('profile.myview',['profile'=>$profile , 'user'=>$user]);
    }

    public function viewProfile($id)
    {

        $profile = Profile::findOrFail($id);

        $user = User::find($id);

        return view('profile.view',['profile'=>$profile , 'user'=>$user]);
    }

    public function editProfile()
    {
        $id = Auth::id();

        $profile = Profile::findOrFail($id);
        $user = User::find($id);

        return view('profile.editform',['profile'=>$profile , 'user'=>$user]);
    }

    public function edit()
    {

    }
}
