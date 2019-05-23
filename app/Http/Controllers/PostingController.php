<?php

namespace App\Http\Controllers;

use App\Comment;
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
use Illuminate\Support\Facades\DB;
use Validator;

class PostingController extends Controller
{

    public function messages()
    {
        return [
            'Judul.required' => 'Judul harus di isi',
            'Caption.required'  => 'Caption harus di isi',
        ];
    }

    public function create(Request $request){ //insert data

        //dd($request->file('fileUpload'));

        $this->validate($request, [
            'Judul' => 'bail|required|unique:posting,judul_posting|max:255',
            'Caption' => 'required|max:255',
            'fileUpload' => 'required|mimetypes:audio/mpeg,image/jpeg,image/png',
        ]);


    	$id = Auth::id();

        $judul = $request->input('Judul');
        //$tipe = $request->input('tipe_posting');
        $caption = $request->input('Caption');

        $posting = new Posting;

        $posting->judul_posting = $judul;
        //$posting->tipe_posting = $tipe;
        $posting->caption = $caption;
        $posting->user_id = $id;


            $file = $request->file('fileUpload'); //file yg diupload

            $filename = time().$request->input('fileUpload');

            $path = Storage::disk('upload')->put($filename, $file);

            $extension = $request->fileUpload->extension();

            $posting->tipe_posting = $extension;

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
        $comments = Comment::where('id_posting',$post_id)->orderby('created_at','asc')->get();

        $post->like_count = $like;

        $url = Storage::url($post->media_path);

        if ($post->user_id!=Auth::id()){
            $post->view_count = $post->view_count + 1;

        }

        $post->save();

//        $url = Storage::temporaryUrl(
//            $post->media_path, Carbon::now()->addMinutes(5)
//        );

        //echo($comments);

        return view('posting.view',['post'=>$post , 'url'=>$url , 'comments'=>$comments ]);
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

    public function likeList($user_id){

        $likes = Like::where('user_id',$user_id)->paginate(5);

        $posting = DB::table('posting')->join('likePosting','posting.id_posting','=','likePosting.id_posting')
            ->where('likePosting.user_id','=',$user_id)
            ->paginate(5);

        //dd($posting);

        return view('posting.likelist',['likes'=>$likes,'posting'=>$posting]);
    }

    public function top10(){

        $posting = Posting::where('view_count','>',1)
            ->orderBy('like_count','desc')
            ->paginate(10);

        return view('posting.result',['posting'=>$posting]);
    }

    public function search(Request $request){

        $keyword = $request->input('keyword');

        $posting = Posting::where('judul_posting','like','%'.$keyword."%")
            ->orWhere('caption','like','%'.$keyword."%")
            ->orderby('created_at','desc')
            ->paginate(5);



        return view('posting.result',['posting'=>$posting]);

    }


}
