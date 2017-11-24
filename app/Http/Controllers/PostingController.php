<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Posting;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostingController extends Controller
{
    public function create(Request $request){ //insert data

        //dd($request->file('fileUpload'));

    	$id = Auth::id();

        $judul = $request->input('Judul');
        //$tipe = $request->input('tipe_posting');
        $caption = $request->input('Caption');

        $posting = new Posting;

        $posting->judul_posting = $judul;
        //$posting->tipe_posting = $tipe;
        $posting->caption = $caption;
        $posting->user_id = $id;


            $file = $request->file('fileUpload');

            $filename = time().$request->input('fileUpload');

            //file_put_contents($filename, $file);


            $path = Storage::disk('upload')->put($filename, $file);

            $posting->media_path = $path;



        $posting->save();

        //setelah insert data langsung nampilin view dari postnya

        return view('posting.view',['post'=>$posting]);

    }

    public function createForm(){

        return view('posting.create');
    }

    public function edit(Request $request){ //insert data


        $id = Auth::id();

        $judul = $request->input('Judul');
        //$tipe = $request->input('tipe_posting');
        $caption = $request->input('Caption');

        $posting = new Posting;

        $posting->judul_posting = $judul;
        //$posting->tipe_posting = $tipe;
        $posting->caption = $caption;
        $posting->user_id = $id;


        $file = $request->file('fileUpload');

        $filename = time().$request->input('fileUpload');

        //file_put_contents($filename, $file);


        $path = Storage::disk('upload')->put($filename, $file);

        $posting->media_path = $path;



        $posting->save();

        //setelah insert data langsung nampilin view dari postnya

        // return view('posting_view',['post'=>$posting]);

    }

    public function viewPost($post_id){

        $post = Posting::findOrFail($post_id);

        $url = Storage::url($post->media_path);

//        $url = Storage::temporaryUrl(
//            $post->media_path, Carbon::now()->addMinutes(5)
//        );

        return view('posting.view',['post'=>$post , 'url'=>$url]);
    }

    public function myPost(){


        $mypost = Posting::where('user_id', Auth::id())->get();


        return view('posting.mypost',['posting'=>$mypost]);
    }

    public function likePost(){


    }
}
