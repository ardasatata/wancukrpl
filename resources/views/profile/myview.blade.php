@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My Profile</div>

                    <div class="panel-body">

                        <a href="{{route('editProfile')}}">EDIT</a>

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
