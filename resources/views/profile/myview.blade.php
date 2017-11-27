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


                            </tr>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
