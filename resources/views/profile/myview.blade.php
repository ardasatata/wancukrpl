@extends('layouts.app')

<title>Wancuk - My Profile</title>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My Profile</div>
                    <div class="panel-body">

                        <header>
                            <div class="profilePhoto">
                                <!-- Profile photo -->
                                <img style="max-width: 150px; max-width: 150px" src="{{ URL::to($profile->profPic)}} "> </div>
                            <!-- Identity details -->
                            <section class="profileHeader">
                                <h1>{{$user->name}}</h1>
                                <h4>{{$profile->description}}</h4>
                                <hr>
                            </section>
                            <p>{{$user->email}}</p>
                                <a class="btn btn-info" href = '{{ route('likeList',['user_id' => \Illuminate\Support\Facades\Auth::id() ]) }}'>Like List</a>
                                <a class="btn btn-info" href="{{route('editProfile')}}">EDIT</a>

                            <!-- Links to Social network accounts -->
                        </header>
                    </div>
                </div>

                <div style="align-items: center" >{{ $posting->links() }}</div>
            </div>


        </div>

        @foreach ($posting as $post)
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href = '{{ route('viewPost',['post_id' => $post->id_posting ]) }}'>{{ $post->judul_posting }} by {{ App\User::userName($post->user_id)}}</a></div>
                    <div class="panel-body">
                        @if($post->tipe_posting=="jpeg" || $post->tipe_posting=="jpg" || $post->tipe_posting=="png")
                            <img style="max-width: 200px" src="{{ URL::to('storage/' . $post->media_path) }}">
                        @elseif($post->tipe_posting=="mpga")
                            <audio src="{{ URL::to('storage/' . $post->media_path) }} " controls>
                                Sorry, your browser doesn't support HTML5 audio
                            </audio>
                        @endif
                        <br>
                        <tr>
                            <td>{{ $post->caption }}</td><br>
                            <td>View : {{$post->view_count}}</td><br>
                            <td>Like : {{$post->like_count}}</td><br>
                        </tr>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



@endsection
