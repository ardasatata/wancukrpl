<?php

namespace App\Http\Controllers;

use App\Posting;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    public function myProfile()
    {
        $id = Auth::id();

        $profile = Profile::findOrFail($id);

        $posting = Posting::where('user_id',$id)->get();

        $user = Auth::user();

        //echo($posting);

        return view('profile.myview',['profile'=>$profile , 'user'=>$user , 'posting' => $posting]);
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

    public function edit(Request $request)
    {
        $id = Auth::id();

        $profile = Profile::findOrFail($id);
        $user = User::find($id);

        $user->name = $request->input('nama');
        $user->email = $request->input('email');
        $profile->description = $request->input('description');

        if ($request->hasFile('fotoProfil')) {

            $foto = $request->file('fotoProfil');

            $filename = Auth::id() . 'profile';

            $image = Image::make($foto);

            $image->fit(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::disk('profile')->put(($filename . '.jpeg'), $image->encode());

            $profile->profpic = Storage::url($filename) . '.jpeg';

        }

        $profile->save();
        $user->save();

        return redirect()->route('myProfile');
    }
}
