@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <div class="container">
                            @foreach ($likes as $like)
                                {{ $like->id_posting }}
                            @endforeach
                        </div>

                        {{ $likes->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
