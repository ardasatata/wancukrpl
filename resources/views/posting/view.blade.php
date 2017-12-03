@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$post->judul_posting}}
                        by {{ App\User::userName($post->user_id) }}
                    @if(!App\Posting::myPost(\Illuminate\Support\Facades\Auth::id(),$post->id_posting))
                            <a href="{{route('viewProfile', ['id' => $post->user_id])}}">{{ App\User::userName($post->user_id) }}</a>
                        @endif
                        @if(App\Posting::myPost(\Illuminate\Support\Facades\Auth::id(),$post->id_posting))
                            <a href="{{route('editPost', ['post_id' => $post->id_posting])}}">Edit</a>
                        @endif
                        @if(App\Posting::myPost(\Illuminate\Support\Facades\Auth::id(),$post->id_posting) || \App\User::isAdmin(true) )
                            <a href="{{route('deletePost', ['post_id' => $post->id_posting])}}">Delete</a>
                        @endif
                    </div>



                    <div class="panel-body">

                <table>
                    <tr>
                        Post ID : {{$post->id_posting}}
                        <br>
                        Caption : {{$post->caption}}
                        <br>
                        View Count : {{$post->view_count}}
                        <br>
                        Like Count : {{$post->like_count}}
                        <br>
                        Created at : {{$post->created_at}}
                        <br>
                        Updated at : {{$post->updated_at}}
                        <br>

                        @if($post->tipe_posting=="jpeg" || $post->tipe_posting=="jpg" || $post->tipe_posting=="png")
                            <img style="max-width: 300px" src="{{ URL::to('storage/' . $post->media_path) }}">
                        @elseif($post->tipe_posting=="mpga")
                            <audio src="{{ URL::to('storage/' . $post->media_path) }} " controls>
                                Sorry, your browser doesn't support HTML5 audio
                            </audio>
                        @endif

                        <br>

                        @if(!(App\Like::hasLike(\Illuminate\Support\Facades\Auth::id(),$post->id_posting)))
                            <a href="{{route('like', ['post_id' => $post->id_posting])}}">LIKE</a>
                        @else
                            <a href="{{route('unlike', ['post_id' => $post->id_posting])}}">UNLIKE</a>
                        @endif

                    </tr>

                </table>
            </div>
        </div>
                <h1>Comment</h1>

                @foreach ($comments as $comment)
                <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ App\User::userName($comment->user_id) }} <a>
                                @if(App\Comment::myComment($comment->user_id) || \App\User::isAdmin(true) )
                                    <a href="{{route('deleteComment', ['user_id' => $comment->id_comment])}}">Delete</a>
                                @endif
                            </a><br>{{ $comment->created_at }}</div>
                        <div class="panel-body">
                        <tr>
                            <td>{{ $comment->comment }}</td><br>
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
