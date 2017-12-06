@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$post->judul_posting}}
                        @if(App\Posting::myPost(\Illuminate\Support\Facades\Auth::id(),$post->id_posting))
                            <a href="{{route('editPost', ['post_id' => $post->id_posting])}}">Edit</a>
                        @endif
                        @if(App\Posting::myPost(\Illuminate\Support\Facades\Auth::id(),$post->id_posting) || \App\User::isAdmin(true) )
                            <a class="btn btn-danger" href="{{route('deletePost', ['post_id' => $post->id_posting])}}">Delete</a>
                        @endif
                    </div>
                    <div class="panel-body">
                <table>
                    <tr>

                        <img style="max-width: 100px" src="{{\App\Profile::profilePic($post->user_id)}}">

                        @if(!App\Posting::myPost(\Illuminate\Support\Facades\Auth::id(),$post->id_posting))
                            <a class="btn btn" href="{{route('viewProfile', ['id' => $post->user_id])}}">{{ App\User::userName($post->user_id) }}</a>
                        @endif

                        <br>
                        <h1>{{$post->caption}}</h1>
                            <hr>
                            <h4>View : {{$post->view_count}}  Like : {{$post->like_count}} </h4>
                        <br>

                            <section>

                        @if($post->tipe_posting=="jpeg" || $post->tipe_posting=="jpg" || $post->tipe_posting=="png")
                            <img style="max-width: 300px" src="{{ URL::to('storage/' . $post->media_path) }}">
                        @elseif($post->tipe_posting=="mpga")
                            <audio src="{{ URL::to('storage/' . $post->media_path) }} " controls>
                                Sorry, your browser doesn't support HTML5 audio
                            </audio>
                        @endif

                            </section>

                        <br>

                        @if(!(App\Like::hasLike(\Illuminate\Support\Facades\Auth::id(),$post->id_posting)))
                            <a class="btn btn-success" href="{{route('like', ['post_id' => $post->id_posting])}}">LIKE</a>
                        @else
                            <a class="btn btn-danger" href="{{route('unlike', ['post_id' => $post->id_posting])}}">UNLIKE</a>
                        @endif

                    </tr>

                    <tr>
                        <br>
                        Created at : {{$post->created_at}}  Updated at : {{$post->updated_at}}
                    </tr>

                </table>
            </div>
        </div>
                <h1>Comment</h1>

                @foreach ($comments as $comment)
                <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading"><img style="max-width: 50px" src="{{\App\Profile::profilePic($comment->user_id)}}">  {{ App\User::userName($comment->user_id) }}
                                @if(App\Comment::myComment($comment->user_id) || \App\User::isAdmin(true) )
                                    <a href="{{route('deleteComment', ['user_id' => $comment->id_comment])}}">Delete</a>
                                @endif
                            </a><br>{{ $comment->created_at }}</div>
                        <div class="panel-body">
                        <tr>
                            <h3><td>{{ $comment->comment }}</td></h3>
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
