@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    @foreach ($posting as $post)

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

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
