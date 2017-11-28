@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My Profile <a href="{{route('editProfile')}}">EDIT</a> </div>

                    <div class="panel-body">

                        <br>

                        <img style="max-width: 250px; max-width: 250px" src="{{ URL::to($profile->profPic)}} ">

                        <br>

                        <table>
                            <tr>
                                {{$user->name}}
                                <br>
                                {{$user->email}}

                                {{$profile->profPic}}

                                {{$profile->description}}

                                <td><a href = '{{ route('likeList',['user_id' => \Illuminate\Support\Facades\Auth::id() ]) }}'>Link</a></td>
                            </tr>

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
