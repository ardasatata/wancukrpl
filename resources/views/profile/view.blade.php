@extends('layouts.app')

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

                        <table>
                            <tr>
                                {{$user->name}}
                                <br>
                                {{$user->email}}

                                {{$profile->profPic}}
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
