@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$post->judul_posting}}</div>

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
                                <a href="{{route('like', ['post_id' => $post->id_posting])}}">LIKE</a>


                                <img style="max-width: 100%" src="{{ URL::to('storage/' . $post->media_path) }} ">

                            </tr>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
