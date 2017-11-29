@extends('layouts.app')

<title>Wancuk - {{$user->name}}</title>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$user->name}}'s Profile
                        @if((App\Follow::isFollowing(\Illuminate\Support\Facades\Auth::id(),$user->id)))
                            <a href="{{route('unfollow', ['user_id' => $user->id])}}">Unfollow</a>
                        @else
                            <a href="{{route('follow', ['user_id' => $user->id])}}">Follow</a>
                        @endif
                    </div>

                    <div class="panel-body">

                        <img style="max-width: 250px; max-width: 250px" src="{{ URL::to($profile->profPic)}} ">
                        <br>
                        <table>
                            <tr>
                                {{$user->name}}
                                <br>
                                {{$user->email}}

                                {{$profile->profPic}}
                            </tr>

                            <td><a href = '{{ route('likeList',['user_id' => \Illuminate\Support\Facades\Auth::id() ]) }}'>Like List</a></td>
                        </table>

                    </div>
                </div>
                <div style="align-items: center" >{{ $posting->links() }}</div>
            </div>
        </div>

        @foreach ($posting as $post)
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Post</div>
                    <div class="panel-body">
                        <tr>
                            <td>{{ $post->id_posting }}</td>
                            <td>{{ $post->judul_posting }}</td>
                            <td><a href = '{{ route('viewPost',['post_id' => $post->id_posting ]) }}'>Link</a></td>
                        </tr>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
