<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Posting;
use Illuminate\Support\Facades\Auth;

class PostingController extends Controller
{
    public function create(Request $request){ //insert data

    	$id=Auth::id();

        $judul = $request->input('judul_posting');
        $tipe = $request->input('tipe_posting');
        $caption = $request->input('caption');

        $posting = new Posting;

        $posting->judul_posting = $judul;
        $posting->tipe_posting = $tipe;
        $posting->caption = $caption;
        $posting->user_id = $id;


        $posting->save();

        //setelah insert data langsung nampilin view dari postnya

        // return view('posting_view',['post'=>$posting]);

    }

    public function createForm(){

        return view('posting.create');
    }

    public function viewPost(){
        
        return view('posting.view');
    }
}
