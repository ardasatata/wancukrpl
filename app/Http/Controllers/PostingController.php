<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Posting;
use Illuminate\Support\Facades\Auth;
use Image;

class PostingController extends Controller
{
    public function create(Request $request){ //insert data

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

            $file->move( public_path('/uploads/UserFiles/' . $filename ) );

            $posting->media_path = $filename;



        $posting->save();

        //setelah insert data langsung nampilin view dari postnya

        // return view('posting_view',['post'=>$posting]);

    }

    public function createForm(){

        return view('posting.create');
    }

    public function viewPost($post_id){

        $post = Posting::findOrFail($post_id);


        return view('posting.view',['post'=>$post]);
    }
}
