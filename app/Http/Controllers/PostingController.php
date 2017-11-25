<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Posting;
use App\Like;
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

            $path = Storage::disk('upload')->put($filename, $file);

            $posting->media_path = $path;



        $posting->save();

        //setelah insert data langsung nampilin view dari postnya

        return redirect()->route('viewPost',['post_id'=>$posting->id_posting]);

    }

    public function createForm(){

        return view('posting.create');
    }

    public function editForm($post_id){

        $post = Posting::findOrFail($post_id);

        return view('posting.edit',['post'=>$post]);
    }

    public function edit(Request $request,$id){ //insert data


        //$id_post = Auth::id();

        $judul = $request->input('Judul');
        //$tipe = $request->input('tipe_posting');
        $caption = $request->input('Caption');

        $posting = Posting::find($id);

        $posting->judul_posting = $judul;
        //$posting->tipe_posting = $tipe;
        $posting->caption = $caption;
        $posting->user_id = $id;

        if ($request->hasFile('fileUpload')) {
            $file = $request->file('fileUpload');

            $filename = time().$request->input('fileUpload');

            $path = Storage::disk('upload')->put($filename, $file);

            $posting->media_path = $path;
        }

        $posting->save();

        return redirect()->route('viewPost', ['post_id' => $id]);
    }

    public function viewPost($post_id){

        $post = Posting::findOrFail($post_id);
        $like = Like::where('id_posting',$post_id)->count();

        $post->like_count = $like;

        $url = Storage::url($post->media_path);

        if ($post->user_id!=Auth::id()){
            $post->view_count = $post->view_count + 1;

        }

        $post->save();

//        $url = Storage::temporaryUrl(
//            $post->media_path, Carbon::now()->addMinutes(5)
//        );

        return view('posting.view',['post'=>$post , 'url'=>$url]);
    }

    public function myPost(){


        $mypost = Posting::where('user_id', Auth::id())->get();


        return view('posting.mypost',['posting'=>$mypost]);
    }

    public function likePost($post_id){

        $id = Auth::id();

        $like = new Like;

        $like->user_id = $id;

        $like->id_posting = $post_id;

        $like->save();

        return back();

    }

    public function unlikePost($post_id){

        $id = Auth::id();

        $like = Like::where('user_id',$id)->where('id_posting',$post_id);

        $like->delete();

        return back();

    }

    public function deletePost($post_id){

        //$id = Auth::id();

        Posting::destroy($post_id);

        return redirect()->route('home');

    }
}
