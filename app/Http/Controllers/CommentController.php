<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment(Request $request){

        $comment = new Comment;

        $comment->user_id = Auth::id();
        $comment->id_posting = $request->post_id;
        $comment->comment = $request->input('comment');

        $comment->save();

        return redirect()->back();
    }

    public function deleteComment($id_comment){ //khusus yg komen


    }
}
