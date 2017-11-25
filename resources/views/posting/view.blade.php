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
                </div>
            </div>
        </div>
    </div>
@endsection
