@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$post->judul_posting}} @if(App\Posting::myPost(\Illuminate\Support\Facades\Auth::id(),$post->id_posting))
                            <a href="{{route('editPost', ['post_id' => $post->id_posting])}}">EDIT</a>
                        @endif
                        @if(App\Posting::myPost(\Illuminate\Support\Facades\Auth::id(),$post->id_posting))
                            <a href="{{route('deletePost', ['post_id' => $post->id_posting])}}">Delete</a>
                        @endif

                        @if(!App\Posting::myPost(\Illuminate\Support\Facades\Auth::id(),$post->id_posting))
                            <a href="{{route('viewProfile', ['id' => $post->user_id])}}">Profile</a>
                        @endif

                    </div>



                    <div class="panel-body">

                        <table>
                            <tr>
                                {{$post->id_posting}}
                                <br>
                                {{$post->caption}}
                                <br>
                                {{$post->view_count}}
                                <br>
                                {{$post->like_count}}
                                <br>
                                {{$post->created_at}}
                                <br>
                                {{$post->updated_at}}
                                <br>

                                @if(!(App\Like::hasLike(\Illuminate\Support\Facades\Auth::id(),$post->id_posting)))
                                    <a href="{{route('like', ['post_id' => $post->id_posting])}}">LIKE</a>
                                @else
                                    <a href="{{route('unlike', ['post_id' => $post->id_posting])}}">UNLIKE</a>
                                @endif

                                <img style="max-width: 100%" src="{{ URL::to('storage/' . $post->media_path) }} ">

                            </tr>

                        </table>
                    </div>
                </div>
                @foreach ($comments as $comment)
                <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ App\User::userName($comment->user_id) }}</div>
                        <div class="panel-body">

                        <tr>
                            <td></td><a>
                                @if(App\Comment::myComment($comment->user_id))
                                    Delete Comment
                                @endif
                            </a><br>
                            <td><h1>{{ $comment->comment }}</h1></td><br>
                        </tr>


                        </div>

                    </div>
                </div>
                </div>
                @endforeach

                <div class="row">

                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action = "{{route('postComment')}}" method = "POST" enctype="multipart/form-data">
                                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                    <input type = "hidden" name = "post_id" value = "{{$post->id_posting}}">
                                    <table>
                                        <tr>
                                            <td><input type='text' name='comment' /></td>
                                        </tr>
                                        <br>
                                        <tr>
                                            <td colspan = '2'><br>
                                                <input type = 'submit' value = "Upload"/>
                                            </td>
                                        </tr>
                                    </table>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
