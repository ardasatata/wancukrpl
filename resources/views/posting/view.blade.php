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
                        @endif </div>



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

                    @foreach ($comments as $comment)
                        <div class="panel-body">
                            <tr>
                                <td>{{ $comment->user_id }}</td>
                                <td>{{ $commentt->comment }}</td>
                                <td><a href = '{{ route('viewPost',['post_id' => $post->id_posting ]) }}'>Link</a></td>
                            </tr>
                        </div>
                    @endforeach


                </div>
                <div class="container">

                    <div class="panel-body">

                        <form action = "{{route('postComment', ['post_id' => $post->id_posting])}}" method = "POST" enctype="multipart/form-data">
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

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
@endsection
